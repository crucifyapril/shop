<?php

namespace App\Repositories;

use App\Models\PromoCode;

class PromoCodeRepository
{
    public function findByCode(string $code): ?Promocode
    {
        return Promocode::query()->where('code', $code)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>=', now());
            })->first();
    }
}
