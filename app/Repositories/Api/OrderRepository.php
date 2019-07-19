<?php

namespace App\Repositories\Api;

use App\Repositories\Order\OrderRepository as MainOrderRepository;

class OrderRepository extends MainOrderRepository
{
    public function checkFirstPurchase($member_id)
    {
        $count = $this->model
            ->where('member_id', $member_id)
            ->count();

        return $count;
    }
}
