<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $code
 * @property int $discount
 * @property string $expires_at
 * @property string $created_at
 * @property string $updated_at
 */
class PromoCode extends Model
{
    protected $fillable = [
        'code',
        'discount',
        'expires_at',
    ];
}
