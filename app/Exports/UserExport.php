<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserExport implements FromCollection, ShouldAutoSize
{
    /**
     * sesuaikan data
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $user = User::where('kelompok_id', '<>', null)->get();
        $data = [];
        $data[] = array('username', 'name', 'nowa', 'himada', 'angkatan', 'alamat', 'email', 'kabkot_id', 'kelompok_id', 'jenis_kelamin', 'nama_statistik', 'prodi', 'nimb', 'status_kelulusan');

        foreach ($user as $u) {
            $row['username']  = $u->username;
            $row['name'] = $u->name;
            $row['nowa'] = $u->nowa;
            $row['himada'] = $u->himada;
            $row['angkatan'] = $u->angkatan;
            $row['alamat'] = $u->alamat;
            $row['email'] = $u->email;
            $row['kabkot_id'] = $u->kabkot_id;
            $row['kelompok_id'] = $u->kelompok_id;
            $row['jenis_kelamin'] = $u->jenis_kelamin;
            $row['nama_statistik'] = $u->nama_statistik;
            $row['prodi'] = $u->prodi;
            $row['nimb'] = $u->nimb;
            $row['status_kelulusan'] = $u->status_kelulusan == 0 ? "TIDAK LULUS" : ($u->status_kelulusan == 1 ? "LULUS" : "MP2K Masih Berlangsung");

            $data[] = $row;
        }

        return collect($data);
    }
}