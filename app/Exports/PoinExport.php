<?php

namespace App\Exports;

use App\Models\Poin\Poin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PoinExport implements FromCollection, ShouldAutoSize
{
    /**
     * sesuaikan data
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $poins = Poin::with(['user', 'jenispoin'])->get();
        $data = [];
        $data[] = array('nama', 'jenis_poin', 'kategori', 'poin', 'urutan_input');

        foreach ($poins as $p) {
            $row['nama']  = $p->user->name;
            $row['jenis_poin'] = $p->jenispoin->nama;
            $row['kategori'] = $p->jenispoin->category == 1 ? "Penghargaan" : ($p->jenispoin->category == 2 ? "Pelanggaran" : "Penebusan");
            $row['poin'] = $p->poin;
            $row['urutan_input'] = $p->urutan_input;

            $data[] = $row;
        }

        return collect($data);
    }
}