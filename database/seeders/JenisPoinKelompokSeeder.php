<?php

namespace Database\Seeders;

use App\Models\Poin\JenisPoin;
use Illuminate\Database\Seeder;

class JenisPoinKelompokSeeder extends Seeder
{
    const JPK_STRING = "Menjadi Kelompok";
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisPoin::create([
            'nama' => self::JPK_STRING.' '.'Terbaik',
            'category' => CATEGORY_JENISPOIN_PENGHARGAAN,
            'poin' => 2
        ]);
    }
}
