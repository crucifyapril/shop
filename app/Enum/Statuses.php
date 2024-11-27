<?php

namespace App\Enum;

enum Statuses: string
{
    case PENDING = 'pending';
    case SUCCEEDED = 'succeeded';
    case WAITING_FOR_CAPTURE = 'waiting_for_capture';
    case CANCELED = 'canceled';
    case ERROR = 'error';
}
