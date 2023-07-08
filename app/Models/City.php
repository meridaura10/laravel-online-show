<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'ref'];
    public function warehouses()
    {
        return $this->hasMany(CityWarehouse::class,'city_ref','ref');
    }
}
