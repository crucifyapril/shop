<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int $total_amount
 * @property int $status_id
 * @property int $user_id
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_amount',
        'status_id',
        'user_id',
        'description',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
