<?php

namespace App\Http\Livewire\Admin\Maba\Event;

use App\Models\Event;
use App\Exports\PresensiExport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;


class ExportPresensi extends Component
{
    public $events;

    public function export()
    {
        $this->validate([
            'events' => 'required'
        ]);
        $export = new PresensiExport();
        $export->setEvents($this->events);
        $title = Event::find($this->events)->first()->title;
        return Excel::download($export, 'Rekap_Presensi_' . $title . '.xlsx');
    }

    public function render()
    {
        return view(
            'admin.maba.event.export-presensi',
            [
                'acara' => Event::presensi()->get()
            ]
        );
    }
}
