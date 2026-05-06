<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 15 random jadwal entries
        Jadwal::factory(15)->create();
    }
}
