<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Api\OrderReviewRepository;
use App\Repositories\Api\ProductCombinationReviewRepository;

class ProductCombinationReviewController extends Controller
{
    /**
    * @var \App\Repositories\ProductCombinationReviewRepository
    */
   
    public function __construct(
       OrderReviewRepository $orderReviewRepository,
       ProductCombinationReviewRepository $productCombinationReviewRepository
    ) {
        $this->orderReviewRepository = $orderReviewRepository;
        $this->productCombinationReviewRepository = $productCombinationReviewRepository;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'token' => 'required|string',
            'productCombinationReviews' => 'required|array',
            'productCombinationReviews.*.stars' => 'required|int',
            'productCombinationReviews.*.comment' => 'required|string',
        ];

        $messages = [
            'token' => 'token 不能為空',
            'productCombinationReviews.required' => '評價星數為必填項目',
            'productCombinationReviews.*.stars.required' => '評價星數為必填項目',
            'productCombinationReviews.*.comment.required' => '評價內容為必填項目',
        ];

        $data = $request->validate($rules, $messages);

        $order_review = $this->orderReviewRepository->getOrderReviewByToken($request->token);

        if (empty($order_review)) {
            throw new HttpResponseException(response()->json([
                'result'        => '404',
                'error_message' => '一般來說，你不會看到這個訊息',
            ]));
        }

        $request["member_id"] = data_get($order_review, 'member_id');
        $product_combination_reviews = $this->productCombinationReviewRepository->createMany($request->all());

        $order_review->delete();

        return response()->json([
            'result'  => '200',
            'message' => '成功更新！',
        ]);
    }
}
