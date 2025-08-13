<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MabaTambahanSeeder extends Seeder
{
    private function getPassword($passMd5, $username)
    {
        // kalau di production pakai pass random yang dikasih, kalau di local pakai username
        if (env('APP_ENV') == 'local')
            return Hash::make(md5($username));

        return Hash::make(md5($passMd5));
    }

    private function isiData($file)
    {
        $data = csv_to_array($file);
        foreach ($data as $item) {

            User::create([
                'name' => $item['name'],
                'username' => $item['username'],
                'email' => $item['email'],
                'nowa' => $item['nowa'],
                'jenis_kelamin' => $item['jenis_kelamin'],
                'prodi' => $item['prodi'],
                'angkatan' => $item['angkatan'],
                'is_active' => 1,
                'alamat' => empty($item['alamat']) ? null : $item['alamat'],
                'kabkot_id' => empty($item['kabkot_id']) ? null : $item['kabkot_id'],
                'password' => $this->getPassword($item['password'], $item['username'])
            ]);
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $this->isiData('database/csv/mabaTambahan.csv');
    }
}
