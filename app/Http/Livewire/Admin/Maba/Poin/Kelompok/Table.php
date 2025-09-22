<?php

namespace App\Http\Livewire\Admin\Maba\Poin\Kelompok;

use App\Models\User;
use App\Models\Day;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class Table extends Component
{
    use WithPagination;
    public $tanggal_poin_kelompok;
    public $selected_day_kelompok; // NEW: Property untuk dropdown hari
    public $search;
    public $tipePoin = -1;
    protected $listeners = ['reloadTablePoinKelompok' => '$refresh'];

    public function updating($name, $value)
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $tanggal_filter = null;

        if ($this->selected_day_kelompok) {
            $dayDate = Day::getDateByName($this->selected_day_kelompok);
            if ($dayDate) {
                $tanggal_filter = $dayDate->format('Y-m-d');
            }
        }

        elseif ($this->tanggal_poin_kelompok) {
            $tanggal_filter = $this->tanggal_poin_kelompok;
        }

        $date = $tanggal_filter ? $tanggal_filter . '%' : null;
        $search = '%' . $this->search . '%';

        return view('admin.maba.poin.kelompok.table', [
            'poin_kelompok' => $this->getHasil($date, $search)
        ]);
    }

    /**
     * NEW: Reset filter method
     */
    public function resetFilter()
    {
        $this->selected_day_kelompok = null;
        $this->tanggal_poin_kelompok = null;
    }

    private function getHasil($date, $search)
    {
        $hasil = User::poinKelompok();

        $hasil->where(function ($query) use ($date, $search) {
            if ($date) {
                $query->where('urutan_input', 'like', $date);
            }

            $query->where('kelompok.nama', 'like', $search);
        });
        if ($this->tipePoin != -1)
            $hasil->where('jenis_poin.category', '=', $this->tipePoin);

        return $hasil->paginate(NUMBER_OF_PAGINATION);
    }
}
