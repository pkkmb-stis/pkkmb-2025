<?php

namespace Database\Seeders;

use App\Models\Kelompok;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class KelompokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') == 'production') {
            $data = csv_to_array('database/csv/kelompok.csv');

            if ($data !== FALSE) {
                foreach ($data as $item) {
                    $kelompok = Kelompok::create([
                        'nama' => $item['nama_kelompok'],
                        'lapk_user_id' => User::where('name', $item['nama_pk'])->first()->id,
                    ]);
                }
            }
        } else {
            //di lokal: menggunakan faker untuk kelompok yg sudah berisi anggota
            $faker = Faker::create();

            $pendamping = User::where('name', '!=', 'Ni Wayan Dani Savitri')
                ->where('name', '!=', 'Milie Diarty')
                ->where('name', '!=', 'Fajar Malik Noor Ahmad')
                ->where('name', '!=', 'Iftina Ika Rahmawati')
                ->role(ROLE_LAPK)
                ->inRandomOrder()
                ->limit(15)
                ->get();

            foreach ($pendamping as $p) {
                for ($j = 0; $j < 2; $j++) {
                    $jumlahAnggota = $faker->numberBetween(18, 20);
                    $kelompok = Kelompok::factory()->create();

                    $maba = User::doesntHave('roles')
                        ->where('kelompok_id', null)
                        ->inRandomOrder()
                        ->limit($jumlahAnggota)
                        ->get();

                    foreach ($maba as $m) {
                        $m->update(['kelompok_id' => $kelompok->id]);
                    }

                    $kelompok->update(['lapk_user_id' => $p->id]);
                }
            }
        }
    }
}
