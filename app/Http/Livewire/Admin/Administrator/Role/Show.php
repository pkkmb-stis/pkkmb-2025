<?php

namespace App\Http\Livewire\Admin\Administrator\Role;

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
        if (!userHasPermission(PERMISSION_DELETE_ROLE))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menghapus role', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                Role::find($this->roleToDelete)->delete();
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menghapus role', 'icon' => 'success', 'iconColor' => 'green']);
                $this->reset('roleToDelete');
            } catch (\Exception $e) {
                $this->dispatchBrowserEvent('updated', ['title' => "Gagal menghapus role", 'icon' => 'error', 'iconColor' => 'red']);
            }
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

        if (!userHasPermission(PERMISSION_ADD_ROLE))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menambahkan  role', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                Role::create([
                    'name' => $this->name,
                    'guard_name' => 'web',
                    'description' => $this->description
                ]);
                $this->isModalOpen = false;
                $this->dispatchBrowserEvent('updated', ['title' => 'Role berhasil ditambah', 'icon' => 'success', 'iconColor' => 'green']);
                $this->reset('name', 'description');
            } catch (\Exception $e) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menambah role', 'icon' => 'error', 'iconColor' => 'red']);
            }
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
