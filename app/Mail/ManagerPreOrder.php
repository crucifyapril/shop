<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ManagerPreOrder extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public $data
    ) {
    }

    public function build(): ManagerPreOrder
    {
        return $this->markdown('mail.orders.manager-pre-order')
            ->with('data', $this->data)
            ->subject('Новый подзаказ');
    }
}
