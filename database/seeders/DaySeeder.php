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
        // Data hari PKKMB 2025 - sesuaikan dengan periode actual
        $days = [
            ['name' => 'PraPKKMB1', 'date' => '2025-10-11', 'description' => 'Pra PKKMB Hari Ke-1'],
            ['name' => 'PraPKKMB2', 'date' => '2025-10-12', 'description' => 'Pra PKKMB Hari Ke-2'],
            ['name' => 'PKKMB1', 'date' => '2025-11-07', 'description' => 'PKKMB Hari Ke-1'],
            ['name' => 'PKKMB2', 'date' => '2025-11-08', 'description' => 'PKKMB Hari Ke-2'],
            ['name' => 'PKKMB3', 'date' => '2025-11-14', 'description' => 'PKKMB Hari Ke-3'],
            ['name' => 'PKKMB4', 'date' => '2025-11-15', 'description' => 'PKKMB Hari Ke-4'],
            ['name' => 'PKKMB5', 'date' => '2025-11-21', 'description' => 'PKKMB Hari Ke-5'],
            ['name' => 'PKKMB6', 'date' => '2025-11-22', 'description' => 'PKKMB Hari Ke-6'],
            ['name' => 'Inaugurasi', 'date' => '2025-12-19', 'description' => 'Inaugurasi'],
        ];

        foreach ($days as $day) {
            Day::create($day);
        }
    }
}
