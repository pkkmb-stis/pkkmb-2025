<?php

use Carbon\Carbon;
use App\Models\User;

if (!function_exists('canAksesNilai')) {
    /**
     * canAksesNilai
     *
     * @return bool
     */
    function canAksesNilai()
    {
        return now() > Carbon::createFromTimeString(CAN_AKSES_NILAI);
    }
}

if (!function_exists('canInputNilai')) {
    /**
     * canInputNilai, yang bisa input yang hanya pinya permission update nilai atau user tersebut merupakan user yang sedang di dampingi
     *
     * @param  mixed $user
     * @return bool
     */
    function canInputNilai(User $user)
    {
        $canInputNilai =  false;
        if ($user->is_maba) {
            $canInputNilai = auth()->user()->can(PERMISSION_UPDATE_NILAI);

            // jika tidak punya akses update nilai cek apakah user yang akan menilai merupakan lapk
            if (!$canInputNilai || auth()->user()->isLapk()) {
                // jika lapk cek apakah maba yang di nilai memiliki pendamping yang akan menilai ini
                $handleKelompok = auth()->user()->handleKelompok->pluck('id')->toArray();
                $canInputNilai =  in_array($user->kelompok_id, $handleKelompok);
            }
        }
        return $canInputNilai;
    }
}

if (!function_exists('getGrade')) {
    /**
     * getGrade
     *
     * @param  mixed $nilai
     * @return string
     */
    function getGrade($nilai)
    {
        if ($nilai >= 85 && $nilai <= 100) return 'A';
        else if ($nilai >= 80 && $nilai < 85) return 'A-';
        else if ($nilai >= 75 && $nilai < 80) return 'B+';
        else if ($nilai >= 70 && $nilai < 75) return 'B';
        else if ($nilai >= 65 && $nilai < 70) return 'C+';
        else if ($nilai >= 60 && $nilai < 65) return 'C';
        else if ($nilai >= 55 && $nilai < 60) return 'D+';
        else if ($nilai >= 40 && $nilai < 55) return 'D';
        else if ($nilai >= 0 && $nilai < 40)  return 'E';
        else return 'E';
    }
}

if (!function_exists('getBobotNilai')) {
    /**
     * getBobotNilai
     *
     * @param  mixed $nilai
     * @return float
     */
    function getBobotNilai($nilai)
    {
        if ($nilai >= 85 && $nilai <= 100) return 4.00;
        else if ($nilai >= 80 && $nilai < 85) return 3.75;
        else if ($nilai >= 75 && $nilai < 80) return 3.5;
        else if ($nilai >= 70 && $nilai < 75) return 3.00;
        else if ($nilai >= 65 && $nilai < 70) return 2.50;
        else if ($nilai >= 60 && $nilai < 65) return 2.00;
        else if ($nilai >= 55 && $nilai < 60) return 1.50;
        else if ($nilai >= 40 && $nilai < 55) return 1.00;
        else if ($nilai >= 0 && $nilai < 40)  return 0.00;
        else return 0.00;
    }
}
