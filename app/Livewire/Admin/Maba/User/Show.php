<?php

namespace App\Livewire\Admin\Maba\User;

use App\Models\Kelompok;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Show extends Component
{
    use WithPagination;

    public $search = '';
    public $kelompok = -1;
    public $daftar_kelompok;
    public $showModalDelete = false;

    /**
     * mount
     *
     * @return void
     */
    public function mount()
    {
        $this->daftar_kelompok = Kelompok::all();
    }

    /**
     * Lifecycle hook untuk reset pagination ketika pencarian atau kelompok berubah
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingKelompok()
    {
        $this->resetPage();
    }

    #[On('reloadUserPage')]
    public function refresh()
    {
        // Magic method $refresh() sekarang menjadi method explicit
    }

    /**
     * getUsers berdasarkan filters
     *
     * @param  mixed $search
     * @return void
     */
    private function getUsers($search)
    {
        $query = User::orderBy('name');

        if ($this->kelompok == 0)
            $query->role(ROLE_PANITIA);
        else if ($this->kelompok > 0) {
            $query->where('kelompok_id', $this->kelompok);
        }

        return $query->where(function ($query) use ($search) {
            $query->where('name', 'like', $search)
                ->orWhere('username', 'like', $search)
                ->orWhere('nimb', 'like', $search);
        })->paginate(NUMBER_OF_PAGINATION);
    }

    /**
     * hapus user
     *
     * @param  mixed $user
     * @return void
     */
    public function hapus(User $user)
    {
        if (!userHasPermission(PERMISSION_DELETE_USER)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk hapus user', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $user->delete();

            $this->dispatch('updated', 
                title: 'Berhasil menghapus user', 
                icon: 'success', 
                iconColor: 'green'
            );
            
        } catch (\Throwable $th) {
            \Log::error('Error deleting user: ' . $th->getMessage());
            
            $this->dispatch('updated', 
                title: 'Gagal menghapus user', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('admin.maba.user.show', ['users' => $this->getUsers($search)]);
    }
}
