<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Court>
 */
class CourtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'COURT_' . fake()->randomLetter() . fake()->randomDigitNotNull(),
            'status' => fake()->randomElement(['tersedia', 'tidak_tersedia', 'maintenance']),
            'harga' => fake()->randomElement([50000, 75000, 100000, 125000, 150000]),
        ];
    }
}
