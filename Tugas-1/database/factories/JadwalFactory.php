<?php

namespace Database\Factories;

use App\Models\Court;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jadwal>
 */
class JadwalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jamMulai = fake()->randomElement(['07:00', '09:00', '11:00', '13:00', '15:00', '17:00', '19:00']);
        $jamSelesai = date('H:i', strtotime($jamMulai) + 3600);

        return [
            'court_id' => Court::factory(),
            'tanggal' => fake()->dateTimeBetween('+1 day', '+30 days')->format('Y-m-d'),
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
            'harga' => fake()->randomElement([50000, 75000, 100000, 125000, 150000]),
            'status' => fake()->randomElement(['tersedia', 'penuh']),
        ];
    }
}
