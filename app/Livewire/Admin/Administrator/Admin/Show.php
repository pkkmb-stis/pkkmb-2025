<?php

namespace App\Livewire\Admin\Administrator\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Show extends Component
{
    use WithPagination;

    private $admin;

    public $search = '';
    public $idRevoke;

    /**
     * set id of user to revoke
     *
     * @param  mixed $id
     * @return void
     */
    public function setIdRevoke($id)
    {
        $this->idRevoke = $id;
    }

    /**
     * reset all search parameters
     *
     * @return void
     */
    #[On('reloadAdminPage')]
    public function reload()
    {
        $this->reset('search', 'idRevoke');
    }

    /**
     * revokeAdmin
     *
     * @return void
     */
    public function revokeAdmin()
    {
        if (!userHasPermission(PERMISSION_DELETE_ADMIN)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk menghapus admin', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        $user = User::find($this->idRevoke);
        
        if (!$user) {
            $this->dispatch('updated', 
                title: 'User tidak ditemukan', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $user->revokePermissionTo(PERMISSION_AKSES_ADMIN);
            $userName = $user->name; // Store name before clearing
            
            $this->idRevoke = '';
            
            $this->dispatch('updated', 
                title: "Berhasil menghapus {$userName} dari admin", 
                icon: 'success', 
                iconColor: 'green'
            );
            
        } catch (\Exception $e) {
            \Log::error('Revoke Admin Error: ' . $e->getMessage());
            
            $this->dispatch('updated', 
                title: 'Gagal menghapus admin', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    /**
     * Lifecycle hook untuk reset pagination ketika pencarian berubah
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $search = '%' . $this->search . '%';

        $query = User::permission(PERMISSION_AKSES_ADMIN)
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', $search)
                    ->orWhereHas('roles', function ($query) use ($search) {
                        $query->where('name', 'like', $search);
                    });
            });

        $this->admin = $query->orderBy('name', 'DESC')
            ->paginate(NUMBER_OF_PAGINATION);

        return view('admin.administrator.admin.show', ['admin' => $this->admin]);
    }
}
