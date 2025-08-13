<?php

namespace App\Exports;

use App\Models\Event;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PresensiExport implements FromCollection, ShouldAutoSize
{

    private $events;


    /**
     * setEvents
     *
     * @param  mixed $events
     * @return void
     */
    public function setEvents($events)
    {
        $this->events = $events;
    }

    /**
     * sesuaikan data
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $acara = Event::presensi()
            ->whereIn('id', $this->events)
            ->with(['user' => function ($q) {
                $q->whereNotNull('kelompok_id');
            }, 'user.kelompok'])
            ->get();
        $data = [];
        $data[] = array('Nama Acara', 'Nama', 'NIM/NIMB', 'Kelompok', 'Status', 'Alasan', 'Mulai Presensi', 'Akhir Presensi', 'Waktu Peserta Presensi', 'Lama Keterlambatan', 'Banyak Presensi');

        foreach ($acara as $a) {
            $row['Nama Acara']  = $a->title;
            $row['Nama'] = '-';
            $row['NIM/NIMB'] = '-';
            $row['Kelompok'] = '-';
            $row['Status'] = '-';
            $row['Alasan'] = '-';
            $row['Mulai Presensi'] = $a->waktu_mulai;
            $row['Akhir Presensi'] = $a->waktu_akhir;
            $row['Waktu Peserta Presensi'] = '-';
            $row['Lama Keterlambatan'] = '-';
            $row['Banyak Presensi'] = '-';

            foreach ($a->user as $u) {
                # code...
                $row['Nama']    = $u->name;
                $row['NIM/NIMB']    = $u->username;
                $row['Jenis Kelamin'] = $u->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan';
                $row['Program Studi'] = $u->prodi;
                $row['Kelompok'] = $u->kelompok->nama;
                $row['Status'] = getStatusAbsensi($u->pivot->status);
                $row['Alasan'] = $u->pivot->alasan;
                $row['Waktu Peserta Presensi'] = '-';
                $row['Lama Keterlambatan'] = '-';

                if ($row['Status'] == 'Tepat Waktu') {
                    $row['Waktu Peserta Presensi'] = $u->pivot->created_at;
                    $row['Banyak Presensi'] = $a->user->only([$u->id])->count() ?? '-';
                }
                if ($row['Status'] == 'Terlambat') {
                    $row['Banyak Presensi'] = $a->user->only([$u->id])->count() ?? '-';
                    $row['Waktu Peserta Presensi'] = $u->pivot->created_at;
                    $diffMin = $a->waktu_akhir->diffInMinutes($u->pivot->created_at, false);
                    $diffDet = $a->waktu_akhir->diffInSeconds($u->pivot->created_at, false);
                    $row['Lama Keterlambatan'] = ($diffMin < 0) ? '0 Menit' : $diffMin . ' Menit ' . ($diffDet % 60) . ' Detik';
                }
                $data[] = $row;
            }

            $mabaTidakPresensi = User::whereNotNull('kelompok_id')
                ->with('kelompok')
                ->orderBy('name')
                ->get()
                ->except($a->user->pluck('id')->toArray());

            $row['Alasan'] = '-';
            $row['Waktu Peserta Presensi'] = '-';
            $row['Lama Keterlambatan'] = '-';
            $row['Banyak Presensi'] = '-';

            foreach ($mabaTidakPresensi as $u) {
                $row['Nama'] = $u->name;
                $row['NIM/NIMB'] = $u->username;
                $row['Kelompok'] = $u->kelompok->nama;
                $row['Status'] = 'Belum Presensi';
                $data[] = $row;
            }
        }

        return collect($data);
    }
}
