<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sum',
        'quantity'
    ];

    public function basketProducts()
    {
        return $this->hasMany(BasketProduct::class)->with('product');
    }
    protected function sum() : Attribute
    {
        return Attribute::make(
            get: fn () => $this->basketProducts()->get()->sum('sum')
        );
    }
}
