<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Language;

class WaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $language_id = (Language::count() == 0) ? Language::factory()->create()->id : Language::first()->id;
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'language_id' => $language_id,
            'wave_id_main' => null,
            'wave_id_language' => null
        ];
    }
}
