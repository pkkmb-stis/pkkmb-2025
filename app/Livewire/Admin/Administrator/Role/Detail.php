<?php

namespace App\Livewire\Admin\Administrator\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Detail extends Component
{
    public $role, $permissionToAdd;
    private $rolePermissions;


    /**
     * addPermission to role
     *
     * @return void
     */
    public function addPermission()
    {
        if (!userHasPermission(PERMISSION_UPDATE_PERMISSION_ROLE)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk menambahkan permission ke role', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        if (!$this->permissionToAdd) {
            $this->dispatch('updated', 
                title: 'Silakan pilih permission', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $this->role->givePermissionTo($this->permissionToAdd);
            
            $this->dispatch('updated', 
                title: 'Permission berhasil ditambah', 
                icon: 'success', 
                iconColor: 'green'
            );
            
            $this->reset('permissionToAdd');
            
        } catch (\Exception $e) {
            \Log::error('Add Permission Error: ' . $e->getMessage());
            
            $this->dispatch('updated', 
                title: 'Permission gagal ditambahkan', 
                icon: 'error',      // FIX: Ubah dari 'success' ke 'error'
                iconColor: 'red'    // FIX: Ubah dari 'green' ke 'red'
            );
        }
    }


    /**
     * revokePermission from role
     *
     * @param  mixed $permission
     * @return void
     */
    public function revokePermission($permission)
    {
        if (!userHasPermission(PERMISSION_UPDATE_PERMISSION_ROLE)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk menghapus permission dari role', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $this->role->revokePermissionTo($permission);
            
            $this->dispatch('updated', 
                title: 'Permission berhasil direvoke', 
                icon: 'success', 
                iconColor: 'green'
            );
            
        } catch (\Exception $e) {
            \Log::error('Revoke Permission Error: ' . $e->getMessage());
            
            $this->dispatch('updated', 
                title: 'Permission gagal direvoke', 
                icon: 'error',      // FIX: Ubah dari 'success' ke 'error'
                iconColor: 'red'    // FIX: Ubah dari 'green' ke 'red'
            );
        }
    }


    public function render()
    {
        // Mengambil semua permission selain permission akses admin
        $permissions = Permission::where('name', '!=', PERMISSION_AKSES_ADMIN)->get();

        $this->rolePermissions = $this->role->getPermissionNames();

        // Mengambil hanya permission yang belum dimiliki role
        $permissions = $permissions->filter(function ($p, $key) {
            return !$this->rolePermissions->contains($p->name);
        });

        return view('admin.administrator.role.detail', [
            'permissions' => $permissions,
            'rolePermissions' => $this->rolePermissions
        ]);
    }
}
