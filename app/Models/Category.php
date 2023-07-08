<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name'];
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps(false);
    }
    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
    protected $fillable = ['title', 'name'];
}