<?php

namespace App\Livewire\Home\Dashboard\Absensi;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class ListAbsensi extends Component
{
    use WithPagination;
    public $showDetailAbsensi = false;
    public $detailAbsensi;
    public $title;

    /**
     * openDetailAbsensi
     *
     * @param  mixed $absensi
     * @param  mixed $title
     * @return void
     */
    public function openDetailAbsensi($absensi = null, $title = "")
    {
        if ($absensi) {
            $this->title = $title;
            $this->detailAbsensi = $absensi;
            $this->showDetailAbsensi = true;
        }
    }

    #[On('refreshListAbsensi')]
    public function refresh()
    {
        // Magic method $refresh() sekarang menjadi method explicit
    }

    public function render()
    {
        return view('home.dashboard.absensi.list-absensi', [
            'absensi' => auth()->user()->event()->orderBy('waktu_mulai', 'desc')->paginate(2),
            'detailAbsensi' => $this->detailAbsensi
        ]);
    }
}
