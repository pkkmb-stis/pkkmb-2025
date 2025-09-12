<?php

namespace App\Livewire\Admin\Maba\Poin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Table extends Component
{
    use WithPagination;
    public $tanggal_poin_user;
    public $search;
    public $jenisUser = "semua"; // maba dan panitia
    public $tipePoin = -1;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingJenisUser()
    {
        $this->resetPage();
    }

    public function updatingTanggalPoinUser()
    {
        $this->resetPage();
    }

    public function updatingTipePoin()
    {
        $this->resetPage();
    }

    #[On('reloadTablePoinUser')]
    public function refresh()
    {
        // Magic method $refresh() sekarang menjadi method explicit
    }

    public function render()
    {
        date_default_timezone_set('Asia/Jakarta');

        $tanggal = $this->tanggal_poin_user == '' ? date('Y-m-d', time()) : $this->tanggal_poin_user;
        $this->tanggal_poin_user = $tanggal;

        $date = $tanggal . "%";
        $search = '%' . $this->search . '%';

        return view('admin.maba.poin.user.table', [
            'poin_user' => $this->getHasil($date, $search)
        ]);
    }

    private function getHasil($date, $search)
    {
        $hasil = User::poinUser();

        $hasil->where(function ($query) use ($date, $search) {
            $query->where('urutan_input', 'like', $date)
                ->where('name', 'like', $search);

            if ($this->jenisUser == 'panitia')
                $query->role(ROLE_PANITIA);

            if ($this->jenisUser == 'maba')
                $query->has('kelompok');
        });

        if ($this->tipePoin != -1)
            $hasil->where('jenis_poin.category', '=', $this->tipePoin);

        return $hasil->paginate(NUMBER_OF_PAGINATION);
    }
}
