<?php

namespace Database\Factories;

use App\Models\Fisher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fisher_id' => Fisher::factory()->create()->id,
            'friend_id' => Fisher::factory()->create()->id,
            'blocked' => false,
            'affinity' => $this->faker->numberBetween(0, 100),
            'points' => null,
            'drops' => null,
            'splashs' => null,
        ];
    }
}
