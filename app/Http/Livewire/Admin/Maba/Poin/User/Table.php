<?php

namespace App\Http\Livewire\Admin\Maba\Poin\User;

use App\Models\User;
use App\Models\Day;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    
    public $tanggal_poin_user;
    public $selected_day_user;
    public $search;
    public $jenisUser = "semua";
    public $tipePoin = -1;
    public $filterDateMode = 'dropdown';
    protected $listeners = ['reloadTablePoinUser' => '$refresh'];

    public function updating($name, $value)
    {
        $this->resetPage();
    }

    public function render()
    {
        $tanggal_filter = null;

        if ($this->filterDateMode === 'dropdown' && $this->selected_day_user) {
            $dayDate = Day::getDateByName($this->selected_day_user);
            if ($dayDate) {
                $tanggal_filter = $dayDate->format('Y-m-d');
            }
        } elseif ($this->filterDateMode === 'manual' && $this->tanggal_poin_user) {
            $tanggal_filter = $this->tanggal_poin_user;
        }

        $search = '%' . $this->search . '%';

        return view('admin.maba.poin.user.table', [
            'poin_user' => $this->getHasil($tanggal_filter, $search)
        ]);
    }

    public function resetFilter()
    {
        $this->reset('selected_day_user', 'tanggal_poin_user');
    }

    private function getHasil($date, $search)
    {
        $hasil = User::poinUser($this->tipePoin);

        $hasil->where(function ($query) use ($search) {
            // Filter non-agregat tetap di 'where'
            $query->where('users.name', 'like', $search);

            if ($this->jenisUser == 'panitia') {
                $query->role(ROLE_PANITIA);
            } elseif ($this->jenisUser == 'maba') {
                $query->has('kelompok');
            } else {
                $query->where(function ($q) {
                    $q->has('kelompok')->orWhere(function ($sub) {
                        $sub->role(ROLE_PANITIA);
                    });
                });
            }
        });

        // Pindahkan kondisi filter tanggal ke 'having'
        if ($date) {
            $hasil->having('terakhir_update', 'like', $date . '%');
        }

        return $hasil->paginate(NUMBER_OF_PAGINATION);
    }
}