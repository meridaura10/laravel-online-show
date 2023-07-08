<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            $langs = localization()->getSupportedLocales();

            foreach ($langs as $lang) {
                $faker = Faker::create($lang->regional());
                $category->translateOrNew($lang->key())->name = $faker->realText(15);
            }

            $category->save();
            gc_collect_cycles();
        });
    }

}