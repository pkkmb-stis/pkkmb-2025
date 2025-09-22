<?php

namespace App\Http\Livewire\Admin\Maba\Poin\User;

use App\Models\User;
use App\Models\Day;
use Livewire\Component;

class RekapHarian extends Component
{
    public $tanggal_rekap;
    public $selected_day;
    //protected $listeners = ['reloadCardRekap' => '$refresh'];

    public function mount()
    {
        $this->selected_day = '';
    }


    public function render()
    {
        $tanggal_filter = null;

        if ($this->selected_day) {
            $dayDate = Day::getDateByName($this->selected_day);
            if ($dayDate) {
                $tanggal_filter = $dayDate->format('Y-m-d');
            }
        }
        
        return view('admin.maba.poin.user.rekap-harian', [
            'rekap' => $this->getRekap($tanggal_filter)
        ]);

        //$this->emit("reloadCardRekap");
    }

    /**
     * NEW: Reset filter method
     */
    public function resetFilter()
    {
        $this->selected_day = null;
        $this->tanggal_rekap = null;
    }

    public function getRekap($tanggal)
    {
        $hasil = User::rekapHarian();

        $hasil->where(function ($query) use ($tanggal) {

            if ($tanggal) {
                $query->where('jenis_poin_user.urutan_input', 'like', $tanggal . "%");
            }
            $query->has('kelompok');
        });

        return $hasil->get();
    }
}