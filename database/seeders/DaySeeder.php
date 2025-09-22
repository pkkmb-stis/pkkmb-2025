<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data hari PKKMB 2024 - sesuaikan dengan periode actual
        $days = [
            ['name' => 'PKKMBH1', 'date' => '2024-09-01', 'description' => 'H1 PKKMB'],
            ['name' => 'PKKMBH2', 'date' => '2024-09-02', 'description' => 'H2 PKKMB'],
            ['name' => 'PKKMBH3', 'date' => '2024-09-03', 'description' => 'H3 PKKMB'],
            ['name' => 'PKKMBH4', 'date' => '2024-09-04', 'description' => 'H4 PKKMB'],
            ['name' => 'PKKMBH5', 'date' => '2024-09-05', 'description' => 'H5 PKKMB'],
            ['name' => 'PKKMBH6', 'date' => '2024-09-06', 'description' => 'H6 PKKMB'],
        ];

        foreach ($days as $day) {
            Day::create($day);
        }
    }
}
