<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class MenuPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guard = "web";
        Permission::insert([
            [
                'name' => PERMISSION_AKSES_ADMIN,
                'guard_name' => $guard,
                'description' => 'Untuk bisa mengakses menu admin dan sebagai penanda utama user yang dapat bertindak sebagai admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_AKSES_MENU_ADMINISTRATOR,
                'guard_name' => $guard,
                'description' => 'Permission utama untuk mengakses submenu yang ada di menu administrator',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_AKSES_MENU_LAPK,
                'guard_name' => $guard,
                'description' => 'Permission utama untuk mengakses submenu yang ada di menu LAPK',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_AKSES_MENU_TIBUM,
                'guard_name' => $guard,
                'description' => 'Permission utama untuk mengakses submenu yang ada di menu TIBUM',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_AKSES_MENU_MABA,
                'guard_name' => $guard,
                'description' => 'Permission utama untuk mengakses submenu yang ada di menu maba',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_AKSES_MENU_INFORMASI,
                'guard_name' => $guard,
                'description' => 'Permission utama untuk mengakses submenu yang ada di menu informasi umum',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
