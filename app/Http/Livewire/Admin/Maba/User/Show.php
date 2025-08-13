<?php

namespace App\Http\Livewire\Admin\Maba\User;

use App\Models\Kelompok;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $search = '';
    public $kelompok = -1;
    public $daftar_kelompok;
    public $showModalDelete = false;

    protected $listeners = ['reloadUserPage' => '$refresh'];

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
        if (!userHasPermission(PERMISSION_DELETE_USER))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk hapus user', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                // sebenarnya disini perlu dihapus seluruh data yang berkaitan dengan user, beserta file filenya di storage, tapi kebutuhan untuk sekarang cukup seperti ini, bisa dikembangkan nantinya

                $user->delete();
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menghapus user', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => $th->getMessage(), 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
    }


    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('admin.maba.user.show', ['users' => $this->getUsers($search)]);
    }
}
