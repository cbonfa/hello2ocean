<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Language;
use App\Models\Wave;

class SplashFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $wave_id = (Wave::count() == 0) ? Wave::factory()->create()->id : Wave::inRandomOrder()->first()->id;
        $language_id = (Language::count() == 0) ? Language::factory()->create()->id : Language::first()->id;
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'blocked' => false,
            'blocked_reason' => null,
            'days_to_expire' => null,
            'wave_id' => $wave_id,
            'language_id' => $language_id,
        ];
    }
}
