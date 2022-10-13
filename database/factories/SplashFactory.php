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
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'blocked' => false,
            'blocked_reason' => null,
            'days_to_expire' => null,
            'wave_id' => Wave::factory()->create()->id,
            'language_id' => Language::factory()->create()->id,
        ];
    }
}
