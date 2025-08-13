<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DosenSeeder extends Seeder
{
    private function getPassword($pass)
    {
        // kalau di production ubah random, kalau di local pakai useername
        if (env('APP_ENV') == 'local')
            return Hash::make(md5($pass));
        return Hash::make(Str::random(10));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = csv_to_array('database/csv/dosen.csv');

        foreach ($data as $item) {
            $user = User::create([
                'name' => $item['name'],
                'username' => $item['username'],
                'email' => $item['email'],
                'is_active' => 1,
                'password' => $this->getPassword($item['username'])
            ]);

            $role = null;

            $user->givePermissionTo(PERMISSION_AKSES_ADMIN);
            $user->assignRole(ROLE_PANITIA);
            $user->assignRole($role);
        }
    }
}
