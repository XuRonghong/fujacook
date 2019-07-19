<?php

namespace App\Http\Controllers\Api;

use App\Formatter\Formatter;
use App\Repositories\Order\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Api\OrderService;

class OrderController extends Controller
{
    use Transaction;

    /**
     * @var \App\Repositories\Order\OrderRepository
     */
    protected $orderRepo;
    private $formatterPath = 'App\Formatter\Api\Orders';
    
    public function __construct(
        OrderRepository $orderRepo,
        OrderService $orderService
    ) {
        $this->orderRepo = $orderRepo;
        $this->orderService = $orderService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $member = $this->getFormatterInstance()->format($this->orderRepo->getOrdersByMember(
            Auth::id(),
            null,
            $request,
            $request->get('per_page', 5),
            [
            'orderDetails.productCombinationProductItem',
            'orderDetails.product.productSpecs',
            'orderDetails.product.cover',
            'orderDetails.productItem.productSpecs',
            'orderDetails.productCombination.categories.parentCategory',
            'paymentMethod',
        ]
        ));
        
        return response()->json([
            'result' => '200',
            'member' => $member,
        ], 200);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    private function store(Request $request)
    {
        $rules = [
            'order' => 'required|array',
            'order.bonus' => 'nullable|numeric',
            'order.coupons' => 'nullable|string',
            'order.note' => 'nullable|string',
            'order.order_contacts' => 'required|array',
            // 訂購人
            'order.order_contacts.0.address' => 'required|string',
            'order.order_contacts.0.county' => 'required|string',
            'order.order_contacts.0.district' => 'required|string',
            'order.order_contacts.0.email' => 'required|string',
            'order.order_contacts.0.name' => 'required|string',
            'order.order_contacts.0.phone' => 'required|string',
            'order.order_contacts.0.type' => 'required|in:1',
            // 收件人
            'order.order_contacts.1.address' => 'required|string',
            'order.order_contacts.1.county' => 'required|string',
            'order.order_contacts.1.district' => 'required|string',
            'order.order_contacts.1.email' => 'required|string',
            'order.order_contacts.1.name' => 'required|string',
            'order.order_contacts.1.phone' => 'required|string',
            'order.order_contacts.1.type' => 'required|in:2',

            'order.shipping_note' => 'nullable|string',
            'order.shipping_type' => 'required|numeric',

            'product_combinations' => 'required|array',
            'product_combinations.*.id' => 'required|numeric',
            'product_combinations.*.products' => 'required|array',
            'product_combinations.*.products.*.id' => 'required|numeric',
            'product_combinations.*.products.*.product_item_id' => 'required|numeric',
            'product_combinations.*.quantity' => 'required|numeric',

            'save_to_contact' => 'boolean',
            'use_contact_to_register' => 'boolean'
        ];

        $data = $request->validate($rules);
        $order = $this->orderService->create($data);
        
        return response()->json([
            'result' => '200',
            'data' => $order,
        ], 200);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    
    public function getFormatterInstance() : Formatter
    {
        $formatterName = studly_case(debug_backtrace()[1]['function']);
        
        return app("{$this->formatterPath}\\{$formatterName}");
    }

    public function updateBankLastNo(Request $request)
    {
        $rules = [
            'no' => 'required|string',
            'bank_last_no' => 'required|digits:5',
        ];

        $messages = [
            'no' => '訂單編號不能為空',
            'bank_last_no.required' => '匯款帳號不能為空',
            'bank_last_no.digits' => '請匯款帳號後五碼，且為數字',
        ];

        $data = $request->validate($rules, $messages);

        $order = $this->orderRepo->getOrderByNo(Auth::id(), $request->no);

        if (!$order) {
            return response()->json([
                'result'  => '400',
                'message' => '更新失敗',
            ]);
        }

        $this->orderRepo->update($data, $order->id);
        
        return response()->json([
            'result'  => '200',
            'message' => '成功更新！',
        ]);
    }
}
