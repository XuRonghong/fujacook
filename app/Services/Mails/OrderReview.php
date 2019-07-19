<?php

//namespace App\Mail;
namespace App\Services\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderReview extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
     * The OrderReview instance.
     *
     * @var OrderReview
     */
    protected $orderReview;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderReview)
    {
        $this->orderReview = $orderReview;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orderReview')
            ->subject('商品評價通知信')
            ->with([
                'name' => $this->orderReview->member->name,
                'order_review_token_url' => config("app.frontend_url")."/order-review/".$this->orderReview->token,
            ]);
    }
}
