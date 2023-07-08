<?php

namespace App\Models;

use App\Enums\ProductImageType;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name', 'description'];


    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps(false);
    }
    public function variations()
    {
        return $this->hasMany(ProductVariation::class)->with('values');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function bannerImage()
    {
        return $this->hasOne(ProductImage::class)->where('type', ProductImageType::BANNER->value);
    }
    public function properties()
    {
        return $this->belongsToMany(Property::class)->withPivot('value');
    }
}