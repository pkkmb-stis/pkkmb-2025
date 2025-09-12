<?php

namespace App\Livewire\Admin\Administrator\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    private $roles;
    public $search, $name, $description, $isModalOpen = false, $roleToDelete;

    protected $rules = [
        'name' => 'required|unique:roles,name',
        'description' => 'required'
    ];

    /**
     * setRoleToDelete
     *
     * @param  mixed $roleId
     * @return void
     */
    public function setRoleToDelete($roleId)
    {
        $this->roleToDelete = $roleId;
    }

    /**
     * deleteRole dan permissionnya
     *
     * @return void
     */
    public function deleteRole()
    {
        if (!userHasPermission(PERMISSION_DELETE_ROLE)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk menghapus role', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        $role = Role::find($this->roleToDelete);
        
        if (!$role) {
            $this->dispatch('updated', 
                title: 'Role tidak ditemukan', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $roleName = $role->name; // Store name before deletion
            $role->delete();
            
            $this->dispatch('updated', 
                title: "Berhasil menghapus role '{$roleName}'", 
                icon: 'success', 
                iconColor: 'green'
            );
            
            $this->reset('roleToDelete');
            
        } catch (\Exception $e) {
            \Log::error('Delete Role Error: ' . $e->getMessage());
            
            $this->dispatch('updated', 
                title: 'Gagal menghapus role', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }


    /**
     * add new role
     *
     * @return void
     */
    public function addRole()
    {
        $this->validate();

        if (!userHasPermission(PERMISSION_ADD_ROLE)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk menambahkan role', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $role = Role::create([
                'name' => $this->name,
                'guard_name' => 'web',
                'description' => $this->description
            ]);
            
            $this->isModalOpen = false;
            
            $this->dispatch('updated', 
                title: 'Role berhasil ditambah', 
                icon: 'success', 
                iconColor: 'green'
            );
            
            $this->reset('name', 'description');
            
        } catch (\Exception $e) {
            \Log::error('Add Role Error: ' . $e->getMessage());
            
            $this->dispatch('updated', 
                title: 'Gagal menambah role', 
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
        $this->roles = Role::where('name', 'like', $search)
            ->paginate(NUMBER_OF_PAGINATION);
        return view('admin.administrator.role.show', ['roles' => $this->roles]);
    }
}
