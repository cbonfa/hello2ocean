<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $country_id = (Country::count() == 0) ? Country::factory()->create()->id : Country::first()->id;
        return [
            'description' => $this->faker->country(),
            'country_id' =>$country_id,
            'locale' => $this->faker->locale(), 
            'active' => true,
        ];
    }
}
