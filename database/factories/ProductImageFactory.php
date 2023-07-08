<?php

namespace Database\Factories;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition()
    {
        return [
            'path' => $this->faker->imageUrl(),
            'disk' => 'public',
        ];
    }

    public function asBanner()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'banner',
                'order' => 0,
            ];
        });
    }
}
