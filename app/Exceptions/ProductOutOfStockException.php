<?php

namespace App\Exceptions;

use Exception;

class ProductOutOfStockException extends Exception
{
    public function __construct($message = 'Недостаточно товара на складе', $code = 422)
    {
        parent::__construct($message, $code);
    }
}
