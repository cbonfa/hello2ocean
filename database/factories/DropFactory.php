<?php

namespace Database\Factories;

use App\Models\Drop;
use App\Models\Fisher;
use App\Models\Language;
use App\Models\Splash;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DropFactory extends Factory
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
            'description' => $this->faker->name(),
            'image' => null,
            'drop_id' => null,
            'splash_id' => Splash::factory()->create()->id,
            'language_id' => Language::factory()->create()->id,
            'blocked' => false,
            'blocked_reason' => null,
            'user_id' => User::factory()->create()->id,
            'fisher_id' => $language_id,
            # 'IP' => $this->faker->ipv4(),
        ];
    }
}
