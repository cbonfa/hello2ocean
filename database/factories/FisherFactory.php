<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Language;

class FisherFactory extends Factory
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
            'profile_image' => $this->faker->imageUrl(150, 150, 'profile', true),
            'nick' => $this->faker->word(),
            'nick_image'  => $this->faker->imageUrl(200, 200, 'nick', true),
            'sign_in_count' => random_int(1, 99),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'last_sign_in_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'language_id' => $language_id,
            'remember_token' => Str::random(10),
        ];
    }
}
