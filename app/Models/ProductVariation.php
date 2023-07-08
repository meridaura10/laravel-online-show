<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $fillable = [
        'product_id',
        'sku',
        'price',
        'quantity',
    ];
    public function values()
    {
        return $this->belongsToMany(OptionValue::class, 'product_variation_values')
            ->withTimestamps()->with('option');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}