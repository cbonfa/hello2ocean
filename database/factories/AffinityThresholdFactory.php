<?php

namespace Database\Factories;

use App\Enums\RevealableField;
use App\Models\AffinityThreshold;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AffinityThreshold>
 */
class AffinityThresholdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'field' => RevealableField::getRandomValue(),
            'min_affinity' => $this->faker->numberBetween(0, 100),
            'description' => $this->faker->sentence(),
            'active' => true,
        ];
    }
}
