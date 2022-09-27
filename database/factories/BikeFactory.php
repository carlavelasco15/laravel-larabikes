<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'marca' => $this->faker->company,
            'modelo' => $this->faker->word(),
            'kms' => $this->faker->numberBetween(0, 1000),
            'precio' => $this->faker->randomFloat(2, 1000, 50000),
            'matriculada' => $this->faker->boolean
        ];
    }
}
