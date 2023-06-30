<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => fake()->name(),
            'type' => fake()->name(),
            'weight' => fake()->numberBetween(500, 1500),
            'performance' => fake()->numberBetween(0, 1000),
            'production_date' => fake()->date(),
        ];
    }
}
