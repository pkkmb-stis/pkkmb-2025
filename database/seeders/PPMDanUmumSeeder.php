<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PPMDanUmumSeeder extends Seeder
{
    private function getPassword($pass, $username)
    {
        // kalau di production ubah random password yang dikasih, kalau di local pakai useername
        if (env('APP_ENV') == 'local')
            return Hash::make(md5($username));
        return Hash::make(md5($pass));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = csv_to_array('database/csv/ppm_dan_umum.csv');

        foreach ($data as $item) {
            $user = User::create([
                'name' => $item['name'],
                'username' => $item['username'],
                'email' => $item['email'],
                'nowa' => $item['nowa'],
                'angkatan' => $item['angkatan'],
                'is_active' => 1,
                'password' => $this->getPassword($item['password'], $item['username'])
            ]);

            $user->givePermissionTo(PERMISSION_AKSES_ADMIN);
            $user->assignRole(ROLE_PANITIA);
        }

        // semua koor bakalan diaksih akses pengumuman
        $permissionPengumuman = [
            PERMISSION_AKSES_MENU_INFORMASI,
            PERMISSION_SHOW_PENGUMUMAN,
            PERMISSION_ADD_PENGUMUMAN,
            PERMISSION_UPDATE_PENGUMUMAN,
            PERMISSION_DELETE_PENGUMUMAN,
            PERMISSION_SHOW_FORMULIR,
            PERMISSION_ADD_FORMULIR,
            PERMISSION_UPDATE_FORMULIR,
            PERMISSION_DELETE_FORMULIR
        ];

        // Koor PPM
        $koor = User::where('name', 'Elsya Nabila')->first();
        $koor->givePermissionTo($permissionPengumuman);

        // Koor Umum
        $koor = User::where('name', 'Dimas Haafizh Rahman')->first();
        $koor->givePermissionTo($permissionPengumuman);

    }
}
