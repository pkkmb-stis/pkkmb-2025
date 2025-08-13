<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdministratorMenuPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guard = "web";

        // Permssion Submenu admin
        Permission::insert([
            [
                'name' => PERMISSION_SHOW_ADMIN,
                'guard_name' => $guard,
                'description' => 'untuk melihat tabel admin dan menjadi syarat untuk permission lainnya di submenu admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_ADD_ADMIN,
                'guard_name' => $guard,
                'description' => 'untuk menambahkan admin baru',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_ADMIN,
                'guard_name' => $guard,
                'description' => 'untuk menghapus admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_AKSES_ADMIN,
                'guard_name' => $guard,
                'description' => 'untuk menambahkan role dan permission dari admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Permssion Submenu role dan permission
        Permission::insert([
            [
                'name' => PERMISSION_SHOW_ROLE,
                'guard_name' => $guard,
                'description' => 'untuk melihat tabel role dan menjadi syarat untuk permission lainnya di submenu role',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_ADD_ROLE,
                'guard_name' => $guard,
                'description' => 'untuk menambahkan role baru',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_ROLE,
                'guard_name' => $guard,
                'description' => 'untuk menghapus role',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_PERMISSION_ROLE,
                'guard_name' => $guard,
                'description' => 'untuk menambahkan permission disuatu role',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
