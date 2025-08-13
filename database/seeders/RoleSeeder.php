<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guard = "web";

        // Role Super Admin
        $role = Role::create([
            'name' => ROLE_SUPER_ADMIN,
            'guard_name' => $guard,
            'description' => 'Role yang memiliki semua hak akses'
        ]);
        $allPermission = Permission::all()->pluck('name');
        $role->givePermissionTo($allPermission);
        $role->revokePermissionTo(PERMISSION_AKSES_ADMIN);


        // Role Panitia
        $role = Role::create(
            [
                'name' => ROLE_PANITIA,
                'guard_name' => $guard,
                'description' => 'Role untuk panitia dan role yang menjadi pembeda antara admin yang panitia dan yang tidak'
            ],
        );
        $role->givePermissionTo([
            PERMISSION_AKSES_MENU_MABA,
            PERMISSION_SHOW_USER,
            PERMISSION_SHOW_EVENT,
        ]);


        // Role LAPK
        $role = Role::create(
            [
                'name' => ROLE_LAPK,
                'guard_name' => $guard,
                'description' => 'Role yang berisi permission dasar untuk LAPK'
            ],
        );
        // Permission untuk add, delete, dan update semua kelompok hanya untuk koor. Anggota LAPK cuman bisa melakukan aksi berdasarkan kelompok yang dia dampingi
        $role->givePermissionTo([
            PERMISSION_AKSES_MENU_LAPK,
            PERMISSION_SHOW_KELOMPOK,
            PERMISSION_SHOW_NILAI,
            PERMISSION_SHOW_INDIKATOR_PENILAIAN,
            PERMISSION_ADD_ABSENSI
        ]);


        // Role HPD
        $role = Role::create(
            [
                'name' => ROLE_HPD,
                'guard_name' => $guard,
                'description' => 'Role yang berisi permission untuk update informasi PKKMB'
            ],
        );
        $role->givePermissionTo([
            PERMISSION_AKSES_MENU_INFORMASI,
            PERMISSION_SHOW_BERITA,
            PERMISSION_ADD_BERITA,
            PERMISSION_UPDATE_BERITA,
            PERMISSION_SHOW_TIMELINE,
            PERMISSION_UPDATE_TIMELINE,
            PERMISSION_SHOW_GALLERY,
            PERMISSION_ADD_GALLERY,
            PERMISSION_UPDATE_GALLERY,
            PERMISSION_DELETE_GALLERY,
            PERMISSION_SHOW_PENGUMUMAN,
            PERMISSION_ADD_PENGUMUMAN,
            PERMISSION_UPDATE_PENGUMUMAN,
        ]);

        // Role BPH
        $role = Role::create(
            [
                'name' => ROLE_BPH,
                'guard_name' => $guard,
                'description' => 'Role untuk BPH'
            ],
        );
        $role->givePermissionTo([
            PERMISSION_AKSES_MENU_LAPK,
            PERMISSION_AKSES_MENU_TIBUM,
            PERMISSION_AKSES_MENU_INFORMASI,
            PERMISSION_SHOW_INDIKATOR_PENILAIAN,
            PERMISSION_SHOW_KELOMPOK,
            PERMISSION_ADD_DELETE_ANGGOTA_KELOMPOK,
            PERMISSION_SHOW_JENISPOIN,
            PERMISSION_SHOW_PENEBUSAN,
            PERMISSION_SHOW_NILAI,
            PERMISSION_UPDATE_NILAI,
            PERMISSION_SHOW_POIN,
            PERMISSION_SHOW_KENDALA,
            PERMISSION_UPDATE_KENDALA,
            PERMISSION_DELETE_KENDALA,
            PERMISSION_UPDATE_ABSENSI,
            PERMISSION_DELETE_ABSENSI,
            PERMISSION_ADD_EVENT,
            PERMISSION_UPDATE_EVENT,
            PERMISSION_DELETE_EVENT,
            PERMISSION_SHOW_BERITA,
            PERMISSION_UPDATE_BERITA,
            PERMISSION_SHOW_PENGUMUMAN,
            PERMISSION_ADD_PENGUMUMAN,
            PERMISSION_UPDATE_PENGUMUMAN,
            PERMISSION_DELETE_PENGUMUMAN,
            PERMISSION_SHOW_GALLERY,
            PERMISSION_UPDATE_GALLERY,
            PERMISSION_SHOW_TIMELINE,
            PERMISSION_ADD_TIMELINE,
            PERMISSION_DELETE_TIMELINE,
            PERMISSION_UPDATE_TIMELINE,
            PERMISSION_SHOW_MATERI,
            PERMISSION_ADD_MATERI,
            PERMISSION_UPDATE_MATERI,
            PERMISSION_DELETE_MATERI,
            PERMISSION_SHOW_FORMULIR,
            PERMISSION_ADD_FORMULIR,
            PERMISSION_UPDATE_FORMULIR,
            PERMISSION_DELETE_FORMULIR,
            PERMISSION_UPDATE_INFO_TAMBAHAN_USER,
            PERMISSION_DOWNLOAD_PENEBUSAN,
            PERMISSION_ADD_ABSENSI
        ]);

        // Role TIBUM
        $role = Role::create(
            [
                'name' => ROLE_TIBUM,
                'guard_name' => $guard,
                'description' => 'Role dasar untuk seksi TIBUM'
            ],
        );

        $role->givePermissionTo([
            PERMISSION_AKSES_MENU_TIBUM,
            PERMISSION_SHOW_JENISPOIN,
            PERMISSION_ADD_JENISPOIN,
            PERMISSION_UPDATE_JENISPOIN,
            PERMISSION_SHOW_PENEBUSAN,
            PERMISSION_ADD_PENEBUSAN,
            PERMISSION_UPDATE_PENEBUSAN,
            PERMISSION_SHOW_POIN,
            PERMISSION_ADD_POIN,
            PERMISSION_UPDATE_POIN,
            PERMISSION_DELETE_POIN,
            PERMISSION_ADD_ABSENSI,
            PERMISSION_UPDATE_ABSENSI,
            PERMISSION_DELETE_ABSENSI,
            PERMISSION_DOWNLOAD_PENEBUSAN,
            PERMISSION_SHOW_POIN_KELOMPOK
        ]);

        // Role Acara
        $role = Role::create(
            [
                'name' => ROLE_ACARA,
                'guard_name' => $guard,
                'description' => 'Role untuk seksi ACARA'
            ],
        );

        $role->givePermissionTo([
            PERMISSION_ADD_EVENT,
            PERMISSION_UPDATE_EVENT,
            PERMISSION_AKSES_MENU_INFORMASI,
            PERMISSION_SHOW_TIMELINE,
            PERMISSION_ADD_TIMELINE,
            PERMISSION_UPDATE_TIMELINE,
            PERMISSION_ADD_MATERI,
            PERMISSION_UPDATE_MATERI,
            PERMISSION_SHOW_MATERI,
            PERMISSION_DELETE_MATERI
        ]);
    }
}
