<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Repositories\Api\CouponRepository;
use App\Services\Api\CouponService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

use Validator;

class CouponController extends Controller
{
    public function __construct(
        CouponRepository $couponRepository,
        CouponService $couponService
    ) {
        $this->couponRepository = $couponRepository;
        $this->couponService = $couponService;
    }

    public function checkCoupon($coupon_code)
    {
        $coupon = $this->couponService->checkCouponCondition($coupon_code);

        return response()->json([
            'result' => '200',
            'data' => $coupon,
        ], 200);
    }
}
