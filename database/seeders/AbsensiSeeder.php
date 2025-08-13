<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AbsensiSeeder extends Seeder
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
            'name' => PERMISSION_ADD_ABSENSI,
            'guard_name' => $guard,
            'description' => 'Untuk menambahkan absensi baru',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
