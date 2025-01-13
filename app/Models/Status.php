<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 */
class Status extends Model
{
    protected $fillable = [
        'name',
    ];

    public function order(): HasOne
    {
        return $this->HasOne(Order::class);
    }
}
