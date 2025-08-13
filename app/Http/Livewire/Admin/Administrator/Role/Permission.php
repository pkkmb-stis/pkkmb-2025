<?php

namespace App\Http\Livewire\Admin\Administrator\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Livewire\WithPagination;

class Permission extends Component
{
    use WithPagination;

    private $permissions;
    public $search;

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
        $this->permissions = ModelsPermission::where('name', 'like', $search)->paginate(NUMBER_OF_PAGINATION);
        return view('admin.administrator.role.permission', ['permissions' => $this->permissions]);
    }
}
