<?php

namespace Database\Factories;

use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
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
        return $this->afterCreating(function (Option $option) {

            $langs = localization()->getSupportedLocales();
            foreach ($langs as $lang) {
                $faker = Faker::create($lang->regional());
                $option->translateOrNew($lang->key())->title = $faker->realText(15);
            }

            $option->save();
            gc_collect_cycles();
        });
    }
}
