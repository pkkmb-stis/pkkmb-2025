<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class TibumMenuPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guard = "web";

        // Permission submenu Jenis poin
        Permission::insert([
            [
                'name' => PERMISSION_SHOW_JENISPOIN,
                'guard_name' => $guard,
                'description' => 'Untuk melihat list jenis poin, harus diberikan jika ingin create/update/delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_ADD_JENISPOIN,
                'guard_name' => $guard,
                'description' => 'Untuk melakukan add pada jenispoin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_JENISPOIN,
                'guard_name' => $guard,
                'description' => 'Untuk melakukan update pada jenispoin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_JENISPOIN,
                'guard_name' => $guard,
                'description' => 'Untuk melakukan delete pada jenispoin',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        Permission::insert([
            [
                'name' => PERMISSION_SHOW_PENEBUSAN,
                'guard_name' => 'web',
                'description' => 'Untuk melihat semua penebusan, harus diberikan jika ingin create/update/delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_ADD_PENEBUSAN,
                'guard_name' => 'web',
                'description' => 'Untuk menambah penebusan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_PENEBUSAN,
                'guard_name' => 'web',
                'description' => 'Untuk update penebusan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_PENEBUSAN,
                'guard_name' => 'web',
                'description' => 'Untuk menghapus penebusan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DOWNLOAD_PENEBUSAN,
                'guard_name' => 'web',
                'description' => 'Untuk download tugas penebusan',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
