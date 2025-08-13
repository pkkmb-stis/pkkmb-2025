<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PPOSeeder extends Seeder
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
        $data = csv_to_array('database/csv/ppo.csv');

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

            if ($item['role'] == 'KPO' || $item['role'] == 'WKPO' || $item['role'] == 'Sekretaris' || $item['role'] == 'Bendahara')
                $role = ROLE_BPH;
            else if ($item['role'] == 'Acara')
                $role = ROLE_ACARA;
            else if ($item['role'] == 'Tibum')
                $role = ROLE_TIBUM;
            else if ($item['role'] == 'HPD')
                $role = ROLE_HPD;
            else if ($item['role'] == 'LAPK')
                $role = ROLE_LAPK;
            else if ($item['role'] == 'Gramti')
                $role = ROLE_SUPER_ADMIN;
            else
                $role = null;

            $user->givePermissionTo(PERMISSION_AKSES_ADMIN);
            $user->assignRole(ROLE_PANITIA);
            $user->assignRole($role);
        }

        // semua koor bakalan diaksih akses pengumuman dan formulir
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

        // koor Tibum
        $koor = User::where('name', 'Imam Fathoni Arufi')->first();
        $koor->givePermissionTo([
            PERMISSION_DELETE_JENISPOIN,
            PERMISSION_DELETE_PENEBUSAN,
            PERMISSION_OTOMATIS_POIN,
            PERMISSION_SHOW_FAQ,
            PERMISSION_ADD_FAQ,
            PERMISSION_UPDATE_FAQ,
            PERMISSION_DELETE_FAQ,
        ]);
        $koor->givePermissionTo($permissionPengumuman);

        // koor LAPK
        $koor = User::where('name', 'Fadiah Yahya')->first();
        $koor->givePermissionTo([
            PERMISSION_UPDATE_INFO_TAMBAHAN_USER,
            PERMISSION_ADD_KELOMPOK,
            PERMISSION_ADD_DELETE_ANGGOTA_KELOMPOK,
            PERMISSION_UPDATE_KELOMPOK,
            PERMISSION_DELETE_KELOMPOK,
            PERMISSION_ADD_INDIKATOR_PENILAIAN,
            PERMISSION_UPDATE_INDIKATOR_PENILAIAN,
            PERMISSION_DELETE_INDIKATOR_PENILAIAN,
            PERMISSION_UPDATE_NILAI,
            PERMISSION_SHOW_FAQ,
            PERMISSION_ADD_FAQ,
            PERMISSION_UPDATE_FAQ,
            PERMISSION_DELETE_FAQ,
        ]);
        $koor->givePermissionTo($permissionPengumuman);

        // koor acara
        $koor = User::where('name', 'Zahra Mufidah Ariani')->first();
        $koor->givePermissionTo([
            PERMISSION_DELETE_EVENT,
            PERMISSION_DELETE_TIMELINE
        ]);
        $koor->givePermissionTo($permissionPengumuman);

        // koor HPD
        $koor = User::where('name', 'Dustin Raka Widiananta Aslam')->first();
        $koor->givePermissionTo([
            PERMISSION_DELETE_BERITA,
            PERMISSION_DELETE_PENGUMUMAN,
            PERMISSION_DELETE_TIMELINE
        ]);
    }
}
