<?php

namespace App\Exports;

use App\Models\Kendala;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class KendalaExport implements FromCollection, ShouldAutoSize
{
    /**
     * sesuaikan data
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $kendala = Kendala::with('user.kelompok')
            ->whereHas('user', function ($q) {
                $q->whereNotNull('kelompok_id');
            })
            ->orderBy('waktu_kendala', 'desc')
            ->get();
        $data = [];

        $row['Waktu Terkena Kendala'] = 'Waktu Terkena Kendala';
        $row['Nama'] = 'Nama';
        $row['Kelompok'] = 'Kelompok';
        $row['NIM/NIMB'] = 'NIM/NIMB';
        $row['Detail Kendala'] = 'Detail Kendala';
        $row['Detail Tanggapan'] = 'Detail Tanggapan';
        $row['Jenis Kendala'] = 'Jenis Kendala';
        $row['Status'] = 'Status';
        $row['Link Foto Kendala'] = 'Link Foto Kendala';
        $row['Link Foto Perlengkapan'] = 'Link Foto Perlengkapan';
        $row['Link Foto Atribut'] = 'Link Foto Atribut';
        $row['Kendala Disampaikan Pada'] = 'Kendala Disampaikan Pada';
        $row['Terakhir Status Diupdate'] = 'Terakhir Status Diupdate';

        $data[] = $row;

        foreach ($kendala as $k) {
            $row['Waktu Terkena Kendala'] = $k->waktu_kendala;
            $row['Nama'] = $k->user->name;
            $row['Kelompok'] = $k->user->kelompok->nama;
            $row['NIM/NIMB'] = $k->user->username;
            $row['Detail Kendala'] = $k->content;
            $row['Detail Tanggapan'] = $k->tanggapan;
            $row['Jenis Kendala'] = getJenisKendala($k->category);
            $row['Status'] = getStatusKendala($k->status);
            $row['Link Foto Kendala'] = $k->foto_kendala ? Storage($k->foto_kendala) : null;
            $row['Link Foto Perlengkapan'] = $k->foto_perlengkapan ? Storage($k->foto_perlengkapan) : null;
            $row['Link Foto Atribut'] = $k->foto_atribute ? Storage($k->foto_atribute) : null;
            $row['Kendala Disampaikan Pada'] = $k->created_at;
            $row['Terakhir Status Diupdate'] = $k->updated_at;
            $data[] = $row;
        }
        return collect($data);
    }
}
