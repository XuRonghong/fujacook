<?php

namespace App\Services\Mails;

use Illuminate\Support\Facades\Mail;
//use App\Mail\OrderReview;
use App\Services\Mails;

class OrderReviewService
{
    public function __construct(
        OrderReviewRepository $orderReviewRepository
    ) {
        $this->orderReviewRepository = $orderReviewRepository;
    }

    public function sendOrderReviewMails()
    {
        $getCompleteOrders = $this->orderReviewRepository->getCompleteOrders();

        foreach ($getCompleteOrders as $orderReview) {
            Mail::to(array_get($orderReview, 'member.email'))
                ->queue(new OrderReview($orderReview));
        }
    }
}
