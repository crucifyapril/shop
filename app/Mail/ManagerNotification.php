<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ManagerNotification extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public $data
    ) {
    }

    public function build(): ManagerNotification
    {
        return $this->markdown('mail.orders.manager-notification')
            ->with('data', $this->data)
            ->subject('Новый заказ оформлен');
    }
}
