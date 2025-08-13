<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class MabaMenuPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guard = "web";

        // Permssion Submenu User
        Permission::insert([
            [
                'name' => PERMISSION_SHOW_USER,
                'guard_name' => $guard,
                'description' => 'untuk melihat tabel user dan menjadi syarat untuk permission lainnya di submenu user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_ADD_USER,
                'guard_name' => $guard,
                'description' => 'untuk menambahkan user baru',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_USER,
                'guard_name' => $guard,
                'description' => 'untuk menghapus user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_INFO_BASIC_USER,
                'guard_name' => $guard,
                'description' => 'untuk mengupdate data email dan username dari user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_INFO_TAMBAHAN_USER,
                'guard_name' => $guard,
                'description' => 'untuk mengupdate data tambahan lainnya dari user',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Permission submenu input poin
        Permission::insert([
            [
                'name' => PERMISSION_SHOW_POIN,
                'guard_name' => $guard,
                'description' => 'Untuk melihat semua poin, harus diberikan jika ingin create/update/delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_ADD_POIN,
                'guard_name' => $guard,
                'description' => 'Untuk menambah poin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_POIN,
                'guard_name' => $guard,
                'description' => 'Untuk update poin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_POIN,
                'guard_name' => $guard,
                'description' => 'Untuk menghapus poin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_OTOMATIS_POIN,
                'guard_name' => $guard,
                'description' => 'Untuk generate poin penghargaan otomatis',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Permission kendala
        Permission::insert([
            [
                'name' => PERMISSION_SHOW_KENDALA,
                'guard_name' => $guard,
                'description' => 'Untuk melihat semua kendala, harus diberikan jika ingin update/delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_KENDALA,
                'guard_name' => $guard,
                'description' => 'Untuk update kendala',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_KENDALA,
                'guard_name' => $guard,
                'description' => 'Untuk menghapus kendala',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Permission nilai
        Permission::insert([
            [
                'name' => PERMISSION_SHOW_NILAI,
                'guard_name' => $guard,
                'description' => 'Untuk melihat nilai maba',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_NILAI,
                'guard_name' => $guard,
                'description' => 'Untuk update nilai maba yang dapat permission ini bebas ngedit nilai tanpa harus dia pendampingnya',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Permission event absensi
        Permission::insert([
            [
                'name' => PERMISSION_SHOW_EVENT,
                'guard_name' => $guard,
                'description' => 'Untuk melihat semua event absensi, harus diberikan jika ingin create/update/delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_ADD_EVENT,
                'guard_name' => $guard,
                'description' => 'Untuk menambah event',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_EVENT,
                'guard_name' => $guard,
                'description' => 'Untuk update event',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_EVENT,
                'guard_name' => $guard,
                'description' => 'Untuk menghapus event',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // permission absensi
        Permission::insert([
            [
                'name' => PERMISSION_UPDATE_ABSENSI,
                'guard_name' => $guard,
                'description' => 'Untuk update status absensi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_ABSENSI,
                'guard_name' => $guard,
                'description' => 'Untuk menghapus status absensi',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
