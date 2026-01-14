<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'order_date',
        'notes',
        'follow_up_sent_at',
    ];

    protected $casts = [
        'order_date' => 'date',
        'follow_up_sent_at' => 'datetime',
    ];

    public function scopePendingFollowUp(Builder $query): Builder
    {
        return $query
            ->whereNull('follow_up_sent_at')
            ->whereDate('order_date', '<=', now()->subDays(10)->toDateString());
    }
}
