<?php

namespace Database\Factories;

use App\Models\Court;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = fake()->randomElement(['07:00', '09:00', '11:00', '13:00', '15:00', '17:00', '19:00']);
        $durationHours = fake()->randomElement([1, 2, 3]);
        $endTime = date('H:i', strtotime($startTime) + ($durationHours * 3600));

        $court = Court::inRandomOrder()->first() ?? Court::factory()->create();
        $pricePerHour = $court->harga;
        $totalPrice = $pricePerHour * $durationHours;

        return [
            'booking_code' => 'BK' . strtoupper(Str::random(8)),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory()->create()->id,
            'court_id' => $court->id,
            'date' => fake()->dateTimeBetween('+1 day', '+30 days')->format('Y-m-d'),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'duration_hours' => $durationHours,
            'total_price' => $totalPrice,
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
