<?php

namespace App\Http\Livewire\Admin\Maba\User;

use Livewire\Component;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportUser extends Component
{
    public function export()
    {
        $export = new UserExport();
        $title =  date("Y-m-d H:i:s", time());
        return Excel::download($export, 'Rekap_User_' . $title . '.xlsx');
    }

    public function render()
    {
        return view('admin.maba.user.export-user');
    }
}