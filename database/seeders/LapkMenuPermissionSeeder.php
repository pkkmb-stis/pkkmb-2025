<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class LapkMenuPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guard = "web";

        // Permssion Submenu Atur kelompok
        Permission::insert([
            [
                'name' => PERMISSION_SHOW_KELOMPOK,
                'guard_name' => $guard,
                'description' => 'untuk melihat tabel kelompok dan menjadi syarat untuk permission lainnya di submenu atur kelompok',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_ADD_KELOMPOK,
                'guard_name' => $guard,
                'description' => 'untuk menambahkan kelompok baru',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_ADD_DELETE_ANGGOTA_KELOMPOK,
                'guard_name' => $guard,
                'description' => 'untuk menambah dan menghapus anggota kelompok. Yang punya permission ini bebas menambah/menghapus anggota tanpa dia harus kelompoknya',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_KELOMPOK,
                'guard_name' => $guard,
                'description' => 'untuk mengupdate data yang berkaitan dengan kelompok. Yang punya permission ini bebas menambah/menghapus anggota tanpa dia harus kelompoknya',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_KELOMPOK,
                'guard_name' => $guard,
                'description' => 'untuk menghapus kelompok',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Permssion Submenu indikator penilaian
        Permission::insert([
            [
                'name' => PERMISSION_SHOW_INDIKATOR_PENILAIAN,
                'guard_name' => $guard,
                'description' => 'untuk melihat inidkator penilaian dan menjadi syarat untuk permission lainnya di submenu atur indikator penilaian',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_ADD_INDIKATOR_PENILAIAN,
                'guard_name' => $guard,
                'description' => 'untuk menambahkan indikator penilaian baru',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_INDIKATOR_PENILAIAN,
                'guard_name' => $guard,
                'description' => 'untuk mengupdate data yang berkaitan dengan indikator penilaian',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_INDIKATOR_PENILAIAN,
                'guard_name' => $guard,
                'description' => 'untuk menghapus indikator penilaian',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
