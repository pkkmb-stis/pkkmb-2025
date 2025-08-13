<?php

namespace App\Http\Livewire\Home\Dashboard\Poin;

use App\Models\Poin\Poin;
use Livewire\Component;

class Chart extends Component
{
    protected $listeners = ['refreshChartDashboard' => '$refresh'];

    // chart poin, sengaja dipisahkan agar bisa diupdate
    public function render()
    {
        $poin = auth()->user()->getKalkulasiPoin();
        return view('home.dashboard.poin.chart', [
            'poin' => $poin,
            'listPoin' => Poin::getJSONPoin(auth()->user()->id, $poin['list'])
        ]);
    }
}
