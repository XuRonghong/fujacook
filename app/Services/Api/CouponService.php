<?php

namespace App\Services\Api;

use App\Repositories\Api\CouponRepository;
use App\Repositories\Api\OrderRepository;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class CouponService
{
    private $coupon;
    private $flag = true;

    public function __construct(
        CouponRepository $couponRepository,
        OrderRepository $orderRepository
    ) {
        $this->couponRepository = $couponRepository;
        $this->orderRepository = $orderRepository;
    }

    public function checkCouponCondition($coupon_code)
    {
        $this->coupon = $this->couponRepository->getCoupon($coupon_code);
        
        if (!empty($this->coupon)) {
            $this->checkIsLimit();
            $this->checkIsTimeLimit();
            $this->checkFirstPurchase();
            
            if ($this->flag) {
                return $this->coupon;
            }
        }

        return null;
    }
    
    /**
     * 判斷優惠券 - 是否限量
     *
     * @return Number|Boolean
     *
     */
    public function checkIsLimit()
    {
        if (data_get($this->coupon, 'is_limit')) {
            if (data_get($this->coupon, 'orders_count') >= data_get($this->coupon, 'limit')) {
                $this->flag = false;
            }
        }
    }

    /**
     * 判斷優惠券 - 是否限時
     *
     * @return Boolean
     *
     */
    public function checkIsTimeLimit()
    {
        if (data_get($this->coupon, 'is_time_limit')) {
            $now = Carbon::now();
            $start_at = Carbon::parse(data_get($this->coupon, 'start_at'));
            $end_at = Carbon::parse(data_get($this->coupon, 'end_at'));

            if (!($now >= $start_at && $now < $end_at)) {
                $this->flag = false;
            }
        }
    }

    /**
     * 判斷優惠券 - 是否為首購
     *
     * @return Boolean
     *
     */
    public function checkFirstPurchase()
    {
        if (data_get($this->coupon, 'type') == 3) {
            $member_id = Auth::guard('member')->id();
            $count = $this->orderRepository->checkFirstPurchase($member_id);
            
            if (empty($member_id) || $count > 0) {
                $this->flag = false;
            }
        }
    }
}
