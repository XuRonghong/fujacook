<?php

namespace App\Repositories\Api;

use App\Models\OrderReview;
use App\Repositories\OrderReviewRepository as ExtendsOrderReviewRepository;


class OrderReviewRepository extends ExtendsOrderReviewRepository
{

    public function __construct(OrderReview $model)
    {
        $this->model = $model;
    }

    public function getOrderReviewByToken($token)
    {
        $query = $this->model
            ->with([
                'order.orderDetails'=> function ($query) {
                    $query->groupBy('group_key');
                },
                'order.orderDetails.productCombination.products.cover',
                'member',
            ])
            ->where('token', $token)
            ->first();
        return $query;
    }

}
