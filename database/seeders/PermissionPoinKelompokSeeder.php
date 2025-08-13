<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionPoinKelompokSeeder extends Seeder
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
            'name' => PERMISSION_SHOW_POIN_KELOMPOK,
            'guard_name' => $guard,
            'description' => 'Untuk show dan menambahkan poin kelompok untuk kelompok terbaik dan terburuk',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}