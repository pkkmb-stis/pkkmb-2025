<?php

namespace App\Http\Livewire\Admin\Maba\Kendala;

use App\Exports\KendalaExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ExportKendala extends Component
{
    public function export()
    {
        return Excel::download(new KendalaExport(), 'Rekap_Kendala.xlsx');
    }
    public function render()
    {
        return view('admin.maba.kendala.export-kendala');
    }
}
