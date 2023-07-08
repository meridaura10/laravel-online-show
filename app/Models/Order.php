<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'status',
        'user_id',
        'api',
        'total'
    ];
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class)->with('product');
    }

    public function address()
    {
        return $this->hasOne(OrderAddress::class);
    }

    public function payment()
    {
        return $this->hasOne(OrderPayment::class);
    }
}
