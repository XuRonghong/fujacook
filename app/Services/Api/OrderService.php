<?php

namespace App\Services\Api;

use App\Repositories\Api\ParameterRepository;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Api\ProductCombinationRepository;
use App\Repositories\Api\ProductCombinationProductItemRepository;
use App\Repositories\Api\MemberRepository;
use App\Repositories\Api\MemberContactRepository;
use App\Services\Api\CouponService;
use App\Services\Api\MemberContactService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use Carbon\Carbon;

class OrderService
{
    protected $member;
    protected $memberIsLogin = false;
    protected $catcheAll;
    protected $order;
    protected $product_combinations;
    protected $totalProductItemPrice = 0;
    protected $totalDiscount = 0;
    protected $finalPrice = 0;
    protected $shipping_fee = 0;
    
    public function __construct(
        ParameterRepository $parameterRepository,
        OrderRepository $orderRepository,
        ProductCombinationRepository $productCombinationRepository,
        ProductCombinationProductItemRepository $productCombinationProductItemRepository,
        CouponService $couponService,
        MemberContactService $memberContactService,
        MemberRepository $memberRepository,
        MemberContactRepository $memberContactRepository
    ) {
        $this->parameterRepository = $parameterRepository;
        $this->orderRepository = $orderRepository;
        $this->productCombinationRepository = $productCombinationRepository;
        $this->productCombinationProductItemRepository = $productCombinationProductItemRepository;
        $this->couponService = $couponService;
        $this->memberContactService = $memberContactService;
        $this->memberRepository = $memberRepository;
        $this->memberContactRepository = $memberContactRepository;

        if (Auth::guard('member')->id()) {
            $this->member = $this->memberRepository->find(Auth::guard('member')->id());
            $this->memberIsLogin = true;
        }
    }

    public function create($attributes)
    {  
        $product_combinations = $attributes['product_combinations'];
        $order = $attributes['order'];
        
        $orderEmail = $order['order_contacts'][0]['email']; // 訂購人信箱

        // 未登入會員
        if (!$this->memberIsLogin) {
            // 判斷信箱是否存在
            $tempMember = $this->checkOrderEmailExist($orderEmail);
            $this->member = $tempMember;
        }
        
        // 付款方式暫定 [5: ATM]
        $order['payment_method_id'] = 5;

        // 處理商品
        $orderDetailData = array();
        foreach ($product_combinations as $group_key => $product_combination) {
            $tempData['product_combination_id'] = $product_combination['id'];
            $tempData['quantity'] = data_get($product_combination, 'quantity');
            
            $pc = $this->productCombinationRepository->getProductCombinationsById($product_combination);
            
            // 判斷該組合商品上/下架
            if (empty($pc)) {
                // 已下架
            }

            // 判斷限時組合商品
            $type = data_get($pc, 'type');

            if ($type == 2) {
                $now = Carbon::now();
                $start_at = Carbon::parse(data_get($pc, 'productCombinationCountdown.start_date'));
                $end_at = Carbon::parse(data_get($pc, 'productCombinationCountdown.end_date'));

                if ($now >= $start_at && $now < $end_at) {
                    // 已超過限時時間
                }
            }

            foreach ($product_combination['products'] as $productList) {
                $tempData['product_item_id'] = $productList['product_item_id'];
                // 取 product_combination_product_item 資料
                $productCombinationProductItem = $this->productCombinationProductItemRepository->getProductCombinationProductItemByCombinationIdAndItemId(array('product_combination_id' => $tempData['product_combination_id'], 'product_item_id' => $tempData['product_item_id']));
                if (empty($productCombinationProductItem)) {
                    // 資料有誤
                }

                // 判斷庫存
                if ($tempData['quantity'] > $productCombinationProductItem->stock) {
                    // 庫存不足
                }

                // 處理庫存（table: product_combination_product_item）
                // stock: 庫存 - 購買數量, purchased_stock: 賣出 +  購買數量
                $productCombinationProductItem->stock = $productCombinationProductItem->stock - $tempData['quantity'];
                $productCombinationProductItem->purchased_stock = $productCombinationProductItem->purchased_stock + $tempData['quantity'];
                $productCombinationProductItem->save();

                // 加總金額
                $tempData['price'] = data_get($productCombinationProductItem, 'price');
                $this->totalProductItemPrice += $tempData['price'] * $tempData['quantity'];

                $tempData['group_key'] = $group_key;
                $tempData['product_item_id'] = data_get($product_combination, 'products.0.product_item_id');
                $tempData['quantity'] = data_get($product_combination, 'quantity');
                $tempData['product_combination_product_item_id'] = $productCombinationProductItem->id;
                $tempData['product_id'] = $productCombinationProductItem->productItem->product_id;
                $tempData['market_price'] = $productCombinationProductItem->market_price; // 原價 (from product_combination_product_item)
                $tempData['price'] = $productCombinationProductItem->price; // 特價 (from product_combination_product_item)
                $tempData['purchase_price'] = $productCombinationProductItem->productItem->purchase_price; // 進價( from product_items)
                $tempData['cost'] = $productCombinationProductItem->productItem->cost; // 成本價 (from product_items)
                
                $orderDetailData[]=$tempData;
            }
        }
        
        // 物流方式 1: 自取 2: 黑貓寄送
        if ($order['shipping_type'] == 2) {
            // 取得免運金額
            $get_free_shipping_over_price = $this->parameterRepository->getParameterByName('free_shipping_over_price');
            $get_shipping_fee = $this->parameterRepository->getParameterByName('shipping_fee');
            
            if (
                empty($get_free_shipping_over_price) ||
                empty(data_get($get_free_shipping_over_price, 'content')) ||
                !($this->totalProductItemPrice >= (int)data_get($get_free_shipping_over_price, 'content'))
            ) {
                // 無免運條件或未達免運條件
                $this->shipping_fee = (int)data_get($get_shipping_fee, 'content');
            }
        }
        
        // 判斷紅利點數
        if ($this->memberIsLogin && !empty($order['bonus'])) {
            $member_bonus = $this->getMemberBounus();
            if ($order['bonus'] > $member_bonus) {
                // 紅利點數不足
                $order['bonus'] = 0;
            } else {
                $bonusLogs['old_bonus'] = $member_bonus;
                $bonusLogs['new_bonus'] = $member_bonus - $order['bonus'];
                $bonusLogs['note'] = '使用' . $order['bonus'] . '點';
            }
        } else {
            $order['bonus'] = 0;
        }
        
        // 判斷優惠券
        if ($order['coupons']) {
            $coupon = $this->couponService->checkCouponCondition($order['coupons']);

            if (!empty($coupon)) {
                // 優惠券有效
                $type = data_get($coupon, 'type');
            
                if ($type == 1) {
                    // 1: 輸入序號打折
                    $this->totalDiscount = $this->totalProductItemPrice - $this->totalProductItemPrice * (data_get($coupon, 'discount_percentage') / 100);
                } elseif ($type == 2 || $type == 3) {
                    // 2: 輸入序號折現金 3: 首次購物折現金
                    $this->totalDiscount = data_get($coupon, 'discount_price');
                }
            } else {
                $order['coupons'] = '';
            }
        }
        
        // 訂單總金額 = 總商品價格 + 運費 - 總折扣
        $this->finalPrice = $this->totalProductItemPrice + $this->shipping_fee - $this->totalDiscount;

        // 補齊訂單資料 - 相關金額
        $order["price"] = $this->totalProductItemPrice; //商品金額
        $order["total_price"] = $this->finalPrice; // 訂單總金額
        $order["shipping_fee"] = $this->shipping_fee; // 運費

        // 新用戶
        if (empty($this->member)) {
            $orderContact = array_get($order, 'order_contacts.0');
            $orderContact['password'] = $orderContact['phone'];
            $orderContact['email'] = $orderEmail;

            $this->member = $this->createMember($orderContact);
        }

        // 新用戶註冊
        if ($attributes['use_contact_to_register']) {
            // $api_token = str_random(64);
            // $this->member->api_token = $api_token;
            $this->member->confirm_terms = 1;
            $this->member->save();
        }
        
        // 是否設為常用通訊地址
        if ($attributes['save_to_contact']) {
            // 判斷筆數
            $checkLimitAndLastRecords = $this->memberContactService->checkLimit(
                $this->memberContactRepository->getMemberContact($this->member->id, null, ['sort' => 'updated_at|desc'])
            );

            // 通訊地址筆數 >= 限制筆數，刪除最後一筆，以利最新一筆新增
            if ($checkLimitAndLastRecords) {
                $this->member->memberContacts()->delete($checkLimitAndLastRecords->id);
            }
            
            $memberContact = array_get($order, 'order_contacts.1');
            $this->member->memberContacts()->create($memberContact);
        }
        
        // 新增訂單主表（table: orders）
        $order['no'] = $this->getNextOrderNo();
        $order['member_id'] = $this->member->id;
        $orderModal = $this->orderRepository->create($order);

        // 新增訂單資料子表（table: order_details）
        $orderDetails = $orderModal->orderDetails()->createMany($orderDetailData);
        
        // 新增訂單訂購人、收件人
        $orderContactsByDeliver = $orderModal->orderContactsByDeliver()->createMany($order['order_contacts']);
        
        // 新增紅利點數紀錄
        if ($order['bonus']) {
            $bonusLogs['order_id'] = $orderModal->id;
            $bonusLogs['member_id'] = $this->member->id;
            $memberBonusLogs = $orderModal->memberBonusLogs()->create($bonusLogs);

            // 更新會員點數
            $this->member->bonus = $bonusLogs['new_bonus'];
            $this->member->save();
        }
        
        // 新增優惠券使用紀錄
        if ($order['coupons']) {
            $coupons = $orderModal->coupons()->syncWithoutDetaching($coupon->id);
        }
        
        if ($attributes['use_contact_to_register']) {
            $orderModal->first_register = true;
        }
        $orderModal->shipping_name = $orderModal->present()->shippingType;
        $orderModal->total_price = number_format($orderModal->total_price);
        $orderModal->member->email = $this->replaceEmailToStar($orderModal->member->email);
        $orderModal->member->phone = $this->replacePhoneToStar($orderModal->member->phone);
        $orderModal->loadMissing(['orderContactsByDeliver', 'orderDetails', 'coupons', 'memberBonusLogs', 'member', 'paymentMethod']);
        
        return $orderModal;
    }

    public function replacePhoneToStar($data)
    {
        return preg_replace('/(\d{2})\d{6}(\d{2})/', '$1******$2', $data);
    }

    public function replaceEmailToStar($data)
    {
        $array = explode('@', $data);
        return substr($array[0], 0, 1)."****".substr($array[0], -1)."@".$array[1];
    }

    public function checkOrderEmailExist(string $email)
    {
        $member = $this->memberRepository->getMemberByEmail($email);
        
        if (!empty($member)) {
            if ($member->confirm_terms == 1) {
                // throw new HttpResponseException(response()->json([
                //     'result'        => '400',
                //     'error_message' => '該訂購人信箱('.$email.')已註冊成為會員，請登入會員以利後續訂購',
                // ]));
            }
        }
        return $member;
    }

    public function createMember(array $data)
    {
        return $this->memberRepository->create($data);
    }

    public function getMemberBounus()
    {
        $member = $this->memberRepository->find(Auth::guard('member')->id());

        if (empty($member)) {
            return 0;
        }

        return $member->bonus;
    }

    /**
     * 取得訂單編號
     */
    public function getNextOrderNo()
    {
        $no = strftime('%Y%m%d%H%M');
        $contentNo = 'O'.$no;

        $last_order_no = $this->parameterRepository->getParameterByNameAndContentAndLock('last_order_no', $contentNo);

        if (!empty($last_order_no)) {
            $no = substr($last_order_no->content, 1, 14);
            $no = (int)$no+1;
        } else {
            $last_order_no = $this->parameterRepository->getParametersByNameAndLock('last_order_no');
            $no = $no . '00';
        }
        
        $last_order_no->content = 'O' . $no;
        $last_order_no->save();

        return $last_order_no->content;
    }
}
