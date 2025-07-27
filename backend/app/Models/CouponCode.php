<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class CouponCode extends Model
{
    protected $table = 'coupon_codes';

    protected $fillable = [
        'name',
        'discount_percentage',
        'is_active',
        'usage_limit',
        'used_count',
        'starts_at',
        'expires_at',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'discount_percentage' => 'float',
        'is_active' => 'boolean',
    ];

    // Scope to check if a coupon is active and valid
    public function scopeValid($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', Carbon::now());
            })
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>=', Carbon::now());
            })
            ->where(function ($q) {
                $q->whereNull('usage_limit')
                    ->orWhereRaw('used_count < usage_limit');
            });
    }

    // Check if this specific coupon is valid
    public function isValid(): bool
    {
        $now = Carbon::now();

        return $this->is_active
            && ($this->starts_at === null || $this->starts_at <= $now)
            && ($this->expires_at === null || $this->expires_at >= $now)
            && ($this->usage_limit === null || $this->used_count < $this->usage_limit);
    }

    // Apply discount to a given amount
    public function applyDiscount(float $amount): float
    {
        return round($amount - ($amount * $this->discount_percentage / 100), 2);
    }

    // Increment usage count when applied
    public function markAsUsed(): void
    {
        $this->increment('used_count');
    }
}
