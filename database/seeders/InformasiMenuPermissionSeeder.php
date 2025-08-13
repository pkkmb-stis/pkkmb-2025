<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class InformasiMenuPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guard = "web";

        // Permission submenu pengumuman
        Permission::insert([
            [
                'name' => PERMISSION_ADD_PENGUMUMAN,
                'guard_name' => $guard,
                'description' => 'Untuk membuat pengumuman',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_SHOW_PENGUMUMAN,
                'guard_name' => $guard,
                'description' => 'Untuk melihat list pengumuman yang ada, harus diberikan jika ingin diberi create/update/delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_PENGUMUMAN,
                'guard_name' => $guard,
                'description' => 'Untuk menghapus pengumuman',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_PENGUMUMAN,
                'guard_name' => $guard,
                'description' => 'Untuk melakukan update pada pengumuman',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Permission submenu berita harian
        Permission::insert([
            [
                'name' => PERMISSION_ADD_BERITA,
                'guard_name' => $guard,
                'description' => 'Untuk membuat berita',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_SHOW_BERITA,
                'guard_name' => $guard,
                'description' => 'Untuk melihat list berita yang ada, harus diberikan jika ingin diberi create/update/delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_BERITA,
                'guard_name' => $guard,
                'description' => 'Untuk menghapus berita',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_BERITA,
                'guard_name' => $guard,
                'description' => 'Untuk melakukan update pada berita',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Permission submenu formulir
        Permission::insert([
            [
                'name' => PERMISSION_ADD_FORMULIR,
                'guard_name' => $guard,
                'description' => 'Untuk membuat formulir',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_SHOW_FORMULIR,
                'guard_name' => $guard,
                'description' => 'Untuk melihat list formulir yang ada, harus diberikan jika ingin diberi create/update/delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_FORMULIR,
                'guard_name' => $guard,
                'description' => 'Untuk menghapus formulir',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_FORMULIR,
                'guard_name' => $guard,
                'description' => 'Untuk melakukan update pada formulir',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Permission submenu gallery
        Permission::insert([
            [
                'name' => PERMISSION_ADD_GALLERY,
                'guard_name' => $guard,
                'description' => 'Untuk membuat gallery',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_SHOW_GALLERY,
                'guard_name' => $guard,
                'description' => 'Untuk melihat list gallery yang ada, harus diberikan jika ingin diberi create/update/delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_GALLERY,
                'guard_name' => $guard,
                'description' => 'Untuk menghapus gallery',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_GALLERY,
                'guard_name' => $guard,
                'description' => 'Untuk melakukan update pada gallery',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Permission submenu timeline
        Permission::insert([
            [
                'name' => PERMISSION_ADD_TIMELINE,
                'guard_name' => $guard,
                'description' => 'Untuk membuat timeline',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_SHOW_TIMELINE,
                'guard_name' => $guard,
                'description' => 'Untuk melihat list timeline yang ada, harus diberikan jika ingin diberi create/update/delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_TIMELINE,
                'guard_name' => $guard,
                'description' => 'Untuk menghapus timeline',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_TIMELINE,
                'guard_name' => $guard,
                'description' => 'Untuk melakukan update pada timeline',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Permission submenu materi
        Permission::insert([
            [
                'name' => PERMISSION_ADD_MATERI,
                'guard_name' => $guard,
                'description' => 'Untuk membuat materi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_SHOW_MATERI,
                'guard_name' => $guard,
                'description' => 'Untuk melihat list materi yang ada, harus diberikan jika ingin diberi create/update/delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_MATERI,
                'guard_name' => $guard,
                'description' => 'Untuk menghapus materi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_MATERI,
                'guard_name' => $guard,
                'description' => 'Untuk melakukan update pada materi',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Permission submenu faq
        Permission::insert([
            [
                'name' => PERMISSION_ADD_FAQ,
                'guard_name' => $guard,
                'description' => 'Untuk membuat faq',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_SHOW_FAQ,
                'guard_name' => $guard,
                'description' => 'Untuk melihat list faq yang ada, harus diberikan jika ingin diberi create/update/delete',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_DELETE_FAQ,
                'guard_name' => $guard,
                'description' => 'Untuk menghapus faq',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => PERMISSION_UPDATE_FAQ,
                'guard_name' => $guard,
                'description' => 'Untuk melakukan update pada faq',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
