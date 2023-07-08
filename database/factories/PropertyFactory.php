<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{

    public function definition()
    {
        return [

        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Property $property) {

            $langs = localization()->getSupportedLocales();
            foreach ($langs as $lang) {
                $faker = Faker::create($lang->regional());
                $property->translateOrNew($lang->key())->title = $faker->realText(15);
            }

            $property->save();
            gc_collect_cycles();
        });
    }


}