<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MabaSeeder extends Seeder
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
                'password' => $this->getPassword($item['password'], $item['username']),
            ]);
        }

        // Jika lingkungan adalah 'local', lakukan update untuk nimb
        if (env('APP_ENV') == 'local') {
            $kelompokCount = 30;
            for ($index = 0; $index < count($data); $index++) {
                $kelompokNumber = str_pad(($index % $kelompokCount) + 1, 2, '0', STR_PAD_LEFT);
                $urutNumber = str_pad(floor($index / $kelompokCount) + 1, 2, '0', STR_PAD_LEFT);
                $nimb = $kelompokNumber . '.' . $urutNumber;

                // Cari pengguna berdasarkan username dan lakukan update untuk nimb
                $user = User::where('username', $data[$index]['username'])->first();
                if ($user) {
                    $user->update(['nimb' => $nimb]);
                }
            }
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $this->isiData('database/csv/maba.csv');
    }
}
