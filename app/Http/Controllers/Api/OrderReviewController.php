<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Api\OrderReviewRepository;

class OrderReviewController extends Controller
{
    /**
     * @var \App\Repositories\OrderReviewRepository
     */
    
    public function __construct(
        OrderReviewRepository $orderReviewRepository
    ) {
        $this->orderReviewRepository = $orderReviewRepository;
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        $order_review = $this->orderReviewRepository->getOrderReviewByToken($token);
        if (empty($order_review)) {
            throw new HttpResponseException(response()->json([
                'result'        => '404',
                'error_message' => '一般來說，你不會看到這個訊息',
            ]));
        }
        
        return response()->json([
            'result' => '200',
            'data' => $order_review,
        ], 200);
    }
}
