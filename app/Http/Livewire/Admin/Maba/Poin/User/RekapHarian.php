<?php

namespace App\Http\Livewire\Admin\Maba\Poin\User;

use App\Models\User;
use Livewire\Component;

class RekapHarian extends Component
{
    public $tanggal_rekap;
    protected $listeners = ['reloadCardRekap' => '$refresh'];

    public function render()
    {
        $tanggal = $this->tanggal_rekap == '' ? date('Y-m-d', time()) : $this->tanggal_rekap;
        $this->tanggal_rekap = $tanggal;

        $date = $tanggal . "%";
        return view('admin.maba.poin.user.rekap-harian', [
            'rekap' => $this->getRekap($date)
        ]);

        $this->emit("reloadCardRekap");
    }

    public function getRekap($date)
    {
        $hasil = User::rekapHarian();

        $hasil->where(function ($query) use ($date) {
            $query->where('jenis_poin_user.urutan_input', 'like', $date);
            $query->has('kelompok');
        });

        return $hasil->get();
    }
}