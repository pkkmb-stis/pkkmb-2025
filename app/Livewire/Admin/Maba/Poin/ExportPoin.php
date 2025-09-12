<?php

namespace App\Livewire\Admin\Maba\Poin;

use Livewire\Component;
use App\Exports\PoinExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportPoin extends Component
{
    public function export()
    {
        $export = new PoinExport();
        $title =  date("Y-m-d H:i:s", time());
        return Excel::download($export, 'Rekap_Poin_' . $title . '.xlsx');
    }

    public function render()
    {
        return view('admin.maba.poin.export-poin');
    }
}