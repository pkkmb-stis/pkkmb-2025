<?php

namespace App\Http\Livewire\Admin\Maba\User\Detail;

use Livewire\Component;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends Component
{
    public $user;
    public $userPermissions;
    public $permissionToRevoke;
    public $permissionToAdd;
    public $permissions;

    /**
     * setPermissionToRevoke
     *
     * @param  mixed $permission
     * @return void
     */
    public function setPermissionToRevoke($permission)
    {
        $this->permissionToRevoke = $permission;
    }

    /**
     * revoke direct permission from user
     *
     * @return void
     */
    public function revokePermission()
    {
        if (!userHasPermission(PERMISSION_UPDATE_AKSES_ADMIN))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menghapus permission dari user ini', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                $this->user->revokePermissionTo($this->permissionToRevoke);
                $this->dispatchBrowserEvent('updated', ['title' => "Permission {$this->permissionToRevoke} berhasil dihapus", 'icon' => 'success', 'iconColor' => 'green']);
                $this->reset('permissionToRevoke');
            } catch (\Exception $e) {
                $this->dispatchBrowserEvent('updated', ['title' => "Permission gagal dihapus", 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
    }

    /**
     * add direct permission to this user
     *
     * @return void
     */
    public function addPermission()
    {
        if (!userHasPermission(PERMISSION_UPDATE_AKSES_ADMIN))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menambah permission dari user ini', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            if ($this->permissionToAdd) {
                try {
                    $this->user->givePermissionTo($this->permissionToAdd);
                    $this->dispatchBrowserEvent('updated', ['title' => "Permission {$this->permissionToAdd} berhasil ditambahkan", 'icon' => 'success', 'iconColor' => 'green']);
                    $this->reset('permissionToAdd');
                } catch (\Exception $e) {
                    $this->dispatchBrowserEvent('updated', ['title' => "Permission gagal ditambahkan", 'icon' => 'error', 'iconColor' => 'red']);
                }
            } else
                $this->dispatchBrowserEvent('updated', ['title' => "Silakan pilih permission", 'icon' => 'error', 'iconColor' => 'red']);
        }
    }

    public function render()
    {
        // Ambil semua permission yang ada dan permission dari user
        $allPermission = ModelsPermission::all();
        $this->userPermissions = $this->user->getPermissionNames();

        // Hanya mengambil permission yang belum dimiliki oleh user
        $this->permissions = $allPermission->filter(function ($p, $key) {
            return !$this->userPermissions->contains($p->name);
        });


        return view('admin.maba.user.detail.permission', [
            'permissions' => $this->permissions,
            'userPermission' => $this->userPermissions->reject(function ($value, $key) {
                return $value == 'akses-admin';
            })
        ]);
    }
}
