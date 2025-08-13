<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionLaporanKegiatan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guard = 'web';

        Permission::insert([
            'name' => PERMISSION_SHOW_LAPORAN_KEGIATAN,
            'guard_name' => $guard,
            'description' => 'Untuk show laporan kegiatan PKKMB-PKBN tiap harinya',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Permission::insert([
            'name' => PERMISSION_ADD_LAPORAN_KEGIATAN,
            'guard_name' => $guard,
            'description' => 'Untuk menambahkan laporan kegiatan PKKMB-PKBN',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Permission::insert([
            'name' => PERMISSION_UPDATE_LAPORAN_KEGIATAN,
            'guard_name' => $guard,
            'description' => 'Untuk mengupdate laporan kegiatan PKKMB-PKBN',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Permission::insert([
            'name' => PERMISSION_DELETE_LAPORAN_KEGIATAN,
            'guard_name' => $guard,
            'description' => 'Untuk menghapus laporan kegiatan PKKMB-PKBN',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
