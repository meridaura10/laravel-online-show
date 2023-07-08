<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'disk', 'type', 'order'];

    public function product()
    {
        return $this->belongsTo(Product::class)->orderBy('order','asc');
    }
}