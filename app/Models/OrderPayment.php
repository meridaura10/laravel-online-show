<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        "payment_id",
        'amount',
        'currency',
        'status',
        'system',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
