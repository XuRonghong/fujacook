<?php

namespace App\Repositories\Api;

use App\Repositories\CouponRepository as MainCouponRepository;

class CouponRepository extends MainCouponRepository
{
    public function getCoupon($code)
    {
        $count = $this->model
            ->where('code', $code)
            ->where('status', '1')
            ->withCount('orders')
            ->first();

        return $count;
    }

}
