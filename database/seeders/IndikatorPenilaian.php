<?php

namespace Database\Seeders;

use App\Models\Indikator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndikatorPenilaian extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Dimensi dan Indikator Penilaian
        Indikator::insert([
            [
                'nama' => 'Wawasan 4 Pilar Kebangsaan',
                'dimensi' => DIMENSI_NASIONALISME,
                'sks' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Etika dan Kedisiplinan',
                'dimensi' => DIMENSI_BUDI_PEKERTI,
                'sks' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Kepemimpinan dan Kerjasama',
                'dimensi' => DIMENSI_BUDI_PEKERTI,
                'sks' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Keterampilan dan Ketelitian',
                'dimensi' => DIMENSI_BERINTELEKTUAL,
                'sks' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Kreativitas',
                'dimensi' => DIMENSI_BERINTELEKTUAL,
                'sks' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Kemampuan Berpikir Kritis dan Wawasan Literasi',
                'dimensi' => DIMENSI_BERINTELEKTUAL,
                'sks' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Wawasan Politeknik Statistika STIS-BPS',
                'dimensi' => DIMENSI_LITERASI,
                'sks' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
