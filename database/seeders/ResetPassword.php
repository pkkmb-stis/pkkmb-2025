<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Ini digunakan karena banyak maba yang tidak bisa reset password sendiri sehingga gramti yang membantu restartkan passwordnya
 */
class ResetPassword extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = csv_to_array('database/csv/resetPassword.csv');
        foreach ($data as $u) {
            $user = User::where('username', $u['no_ujian'])->first();
            $user->update(['password' => Hash::make(md5($u['password']))]);
        }
    }
}
