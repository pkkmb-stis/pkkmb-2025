<?php

namespace Database\Seeders;

use App\Models\Provinsi;
use Illuminate\Database\Seeder;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = csv_to_array('database/csv/provinsi.csv');

        foreach ($data as $item) {
            Provinsi::insert([
                'prov_id' => $item['prov_id'],
                'nama' => $item['nama']
            ]);
        }
    }
}
