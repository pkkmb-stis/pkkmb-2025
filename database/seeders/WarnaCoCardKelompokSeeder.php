<?php

namespace Database\Seeders;

use App\Models\Kelompok;
use Illuminate\Database\Seeder;

class WarnaCoCardKelompokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kelompok = Kelompok::all();

        $warna = [
            '#dcbedc',
            '#dcbedc',
            '#fafa00',
            '#fafa00',
            '#00ff00',
            '#00ff00',
            '#3282ff',
            '#3282ff',
            '#d2aa6e',
            '#d2aa6e',
            '#ff96e6',
            '#ff96e6',
            '#64c896',
            '#64c896',
            '#828282',
            '#828282',
            '#e16e0a',
            '#e16e0a',
            '#64c8ff',
            '#64c8ff',
            '#ff46a0',
            '#ff46a0',
            '#fac878',
            '#fac878',
            '#d232ff',
            '#d232ff',
            '#c8ffc8',
            '#c8ffc8',
            '#ff3232',
            '#ff3232',
        ];

        $i = 0;

        foreach ($kelompok as $k) {
            $k->update(['warna_co_card' => $warna[$i]]);
            $i++;
        }
    }
}
