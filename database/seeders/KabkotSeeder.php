<?php

namespace Database\Seeders;

use App\Models\Kabkot;
use Illuminate\Database\Seeder;

class KabkotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = csv_to_array('database/csv/kabkot.csv');

        foreach ($data as $item) {
            Kabkot::insert([
                'prov_id' => $item['prov_id'],
                'kabkot_id' => $item['kabkot_id'],
                'nama' => $item['nama']
            ]);
        }
    }
}
