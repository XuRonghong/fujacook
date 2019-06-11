<?php

namespace App\Service;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('xxx@xxx.xx')
            ->subject('New Customer Equiry')
            ->view('dynamic_email_template')
            ->with('data', $this->data);

        return $this->view('emails.orderReview')
            ->subject('商品評價通知信')
            ->with([
                'name' => $this->orderReview->member->name,
                'order_review_token_url' => config("app.frontend_url")."/order-review/".$this->orderReview->token,
            ]);

        return $this->view('view.name');
    }
}
