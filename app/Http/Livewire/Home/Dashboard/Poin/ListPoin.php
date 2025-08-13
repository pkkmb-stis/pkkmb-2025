<?php

namespace App\Http\Livewire\Home\Dashboard\Poin;

use Livewire\Component;

class ListPoin extends Component
{
    public $showModalDetail = false;
    public $poinToShow;
    public $detailPoins;

    protected $listeners = ['refreshListPoinDashboard' => '$refresh'];

    /**
     * mount, ambil data yang diperlukan
     *
     * @return void
     */
    public function mount()
    {
        $this->detailPoins = auth()->user()->getKalkulasiPoin();
        if (count($this->detailPoins) != 0) {
            $this->detailPoins = $this->detailPoins['list']->toJson();
        }
    }

    public function show($id)
    {
        // Ambil dari data yang di json tadi
        $this->poinToShow = collect(json_decode($this->detailPoins, true))->where('id', $id)->first();
        $this->showModalDetail = true;
    }

    public function render()
    {
        return view('home.dashboard.poin.list-poin', [
            // Urutkan berdasarkan urutan_input atau created_at dari yang terbaru
            'poin' => collect(json_decode($this->detailPoins, true))
                ->sortByDesc('urutan_input') // Ubah 'urutan_input' dengan field timestamp yang sesuai jika berbeda
                ->take(3),
        ]);
    }
}
