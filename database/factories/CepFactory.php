<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cep' => $this->faker->postcode(),
            'logradouro' => $this->faker->streetName(),
            'complemento' => $this->faker->secondaryAddress(),
            'bairro' => $this->faker->state(),
            'cidade' => $this->faker->cityPrefix(),
            'uf' => $this->faker->stateAbbr(),
            'ibge' => $this->faker->buildingNumber(),
        ];
    }
}