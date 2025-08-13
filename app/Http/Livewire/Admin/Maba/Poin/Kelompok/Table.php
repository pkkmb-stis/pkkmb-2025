<?php

namespace App\Http\Livewire\Admin\Maba\Poin\Kelompok;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class Table extends Component
{
    use WithPagination;
    public $tanggal_poin_kelompok;
    public $search;
    public $tipePoin = -1;
    protected $listeners = ['reloadTablePoinKelompok' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingTanggalPoinKelompok()
    {
        $this->resetPage();
    }

    public function updatingTipePoin()
    {
        $this->resetPage();
    }

    public function render()
    {
        date_default_timezone_set('Asia/Jakarta');

        $tanggal = $this->tanggal_poin_kelompok == '' ? date('Y-m-d', time()) : $this->tanggal_poin_kelompok;
        $this->tanggal_poin_kelompok = $tanggal;

        $date = $tanggal . "%";
        $search = '%' . $this->search . '%';

        return view('admin.maba.poin.kelompok.table', [
            'poin_kelompok' => $this->getHasil($date, $search)
        ]);
    }

    private function getHasil($date, $search)
    {
        $hasil = User::poinKelompok();
        $hasil->where(function ($query) use ($date, $search) {
            $query->where('urutan_input', 'like', $date)
                ->where('kelompok.nama', 'like', $search);
        });
        if ($this->tipePoin != -1)
            $hasil->where('jenis_poin.category', '=', $this->tipePoin);

        return $hasil->paginate(NUMBER_OF_PAGINATION);
    }
}
