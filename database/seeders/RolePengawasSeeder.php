<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePengawasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guard = "web";

        // Role Pengawas
        $role = Role::create([
            'name' => ROLE_PENGAWAS,
            'guard_name' => $guard,
            'description' => 'Role yang memiliki akses laporan kegiatan'
        ]);

        $role->givePermissionTo([
            PERMISSION_SHOW_LAPORAN_KEGIATAN,
            PERMISSION_ADD_LAPORAN_KEGIATAN,
            PERMISSION_UPDATE_LAPORAN_KEGIATAN,
            PERMISSION_DELETE_LAPORAN_KEGIATAN,
        ]);
    }
}
