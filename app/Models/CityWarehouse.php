<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityWarehouse extends Model
{
    use HasFactory;
    protected $fillable = ['city_ref','number','address'];

}
