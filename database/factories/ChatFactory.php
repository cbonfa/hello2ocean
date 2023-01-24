<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Fisher;

class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fisher_id' => Fisher::factory()->create()->id,
            'receiver_id' => Fisher::factory()->create()->id,
            'text_sent' => $this->faker->text(),
            'received_text' => $this->faker->text()
        ];
    }
}
