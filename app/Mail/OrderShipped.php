<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public $data
    ) {
    }

    public function build(): OrderShipped
    {
        return $this->markdown('mail.orders.shipped')
            ->with('data', $this->data)
            ->subject('Информация о заказе');
    }
}
