<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
  
    public function run()
    {
        // Створення категорій
        $category1 = Category::create([
            'name' => 'Мобільні телефони',
            'slug' => 'mobile-phones',
        ]);

        $category2 = Category::create([
            'name' => 'Ноутбуки',
            'slug' => 'laptops',
        ]);

        // Додавання атрибутів до категорій
        $category1->attributes()->createMany([
            ['name' => 'Колір'],
            ['name' => "Пам'ять"],
        ]);

        $category2->attributes()->createMany([
            ['name' => 'Розмір екрану'],
            ['name' => 'Процесор'],
        ]);

        // Додавання опцій до атрибутів
        $category1->attributes->each(function ($attribute) {
            $attribute->options()->createMany([
                ['name' => 'Чорний'],
                ['name' => 'Білий'],
                ['name' => 'Сріблястий'],
            ]);
        });

        $category2->attributes->each(function ($attribute) {
            $attribute->options()->createMany([
                ['name' => '13"'],
                ['name' => '15"'],
                ['name' => '17"'],
            ]);
        });
    }
}
