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
            '#F08787',
            '#F08787',
            '#9ECAD6',
            '#9ECAD6',
            '#A0C878',
            '#A0C878',
            '#F3C623',
            '#F3C623',
            '#B17F59',
            '#B17F59',
            '#FCEF91',
            '#FCEF91',
            '#7C4585',
            '#7C4585',
            '#F79B72',
            '#F79B72',
            '#EB5B00',
            '#EB5B00',
            '#64C8FF',
            '#64C8FF',
            '#ff46a0',
            '#ff46a0',
            '#C5B0CD',
            '#C5B0CD',
            '#C70039',
            '#C70039',
            '#C8FFC8',
            '#C8FFC8',
            '#98D2C0',
            '#98D2C0',
            '#CC66DA',
            '#CC66DA',
            '#FFC6D3',
            '#FFC6D3',
            '#D98324',
            '#D98324',
        ];

        $i = 0;

        foreach ($kelompok as $k) {
            $k->update(['warna_co_card' => $warna[$i]]);
            $i++;
        }
    }
}
