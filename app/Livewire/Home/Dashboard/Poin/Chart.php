<?php

namespace App\Livewire\Home\Dashboard\Poin;

use App\Models\Poin\Poin;
use Livewire\Component;
use Livewire\Attributes\On;

class Chart extends Component
{
    #[On('refreshChartDashboard')]
    public function refresh()
    {
        // Magic method $refresh() sekarang menjadi method explicit
    }

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
