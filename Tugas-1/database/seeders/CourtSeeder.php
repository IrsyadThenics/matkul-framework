<?php

namespace Database\Seeders;

use App\Models\Court;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourtSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create specific courts
        $courts = [
            ['name' => 'COURT_A', 'status' => 'tersedia', 'harga' => 100000],
            ['name' => 'COURT_B', 'status' => 'tersedia', 'harga' => 100000],
            ['name' => 'COURT_C', 'status' => 'tersedia', 'harga' => 75000],
            ['name' => 'COURT_D', 'status' => 'maintenance', 'harga' => 150000],
            ['name' => 'COURT_E', 'status' => 'tersedia', 'harga' => 125000],
        ];

        foreach ($courts as $court) {
            Court::create($court);
        }

        // Create 5 additional random courts
        Court::factory(5)->create();
    }
}
