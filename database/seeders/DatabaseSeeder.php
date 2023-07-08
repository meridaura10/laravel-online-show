<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Property;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $properties = Property::factory()->count(10)->create();
        $categories = Category::factory()->count(20)->create();
        Option::factory()->count(3)->create();
    
        $optionValues = OptionValue::factory()->count(8)->create();
        Product::factory(10)
            ->hasAttached($properties, function () {
                return ['value' => ucfirst(fake()->word())];
            })
            ->create()
            ->each(function ($product) use ($categories, $properties, $optionValues) {
                $categoryCount = mt_rand(1, 5);
    
                $randomCategories = $categories->random($categoryCount);
    
                $product->categories()->attach($randomCategories);
    
                $randomCategories->each(function ($category) use ($properties) {
                    $propertyCount = mt_rand(1, 5);
                    $randomProperties = $properties->random($propertyCount);
                    $category->properties()->attach($randomProperties);
                });
    
                $variationValues = $optionValues->pluck('id'); // Отримати всі ID зі списку $optionValues
    
                $variations = [
                    [
                        'sku' => 'Варіант 1',
                        'price' => 10.99,
                        'quantity' => 100,
                    ],
                    [
                        'sku' => 'Варіант 2',
                        'price' => 20.99,
                        'quantity' => 50,
                    ],
                    [
                        'sku' => 'Варіант 3',
                        'price' => 20.99,
                        'quantity' => 2,
                    ],
                ];
    
                foreach ($variations as $variationData) {
                    $variation = $product->variations()->create($variationData);
    
                    $colorId = $variationValues->random();
                    $sizeId = $variationValues->random();
                    $materialId = $variationValues->random();
    
                    $variation->values()->attach([$colorId, $sizeId, $materialId]);
                }
    
                for ($i = 0; $i < 5; $i++) {
                    ProductImage::factory()->create([
                        'product_id' => $product->id,
                        'type' => 'banner',
                        'order' => $i + 1,
                    ]);
                }
    
                ProductImage::factory()->create([
                    'product_id' => $product->id,
                    'type' => 'banner',
                    'order' => 0,
                ]);
            });
    }
    
}