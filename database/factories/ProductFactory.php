<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $langs = localization()->getSupportedLocales();

            foreach ($langs as $lang) {
                $faker = Faker::create($lang->regional());
                $product->translateOrNew($lang->key())->name = $faker->realText(30);
                $product->translateOrNew($lang->key())->description = $faker->realText(500,2);
            }

            $product->save();
            gc_collect_cycles();
        });
    }
}