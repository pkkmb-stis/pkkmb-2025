<?php

namespace App\Http\Livewire\Admin\Maba\User\Detail;

use Livewire\Component;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends Component
{
    public $user;
    public $userRoles;
    public $roleToRevoke;
    public $roleToAdd;
    public $roles;

    /**
     * setRoleToRevoke
     *
     * @param  mixed $role
     * @return void
     */
    public function setRoleToRevoke($role)
    {
        $this->roleToRevoke = $role;
    }

    /**
     * revokeRole of user
     *
     * @return void
     */
    public function revokeRole()
    {
        if (!userHasPermission(PERMISSION_UPDATE_AKSES_ADMIN))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menghapus role dari user ini', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                $this->user->removeRole($this->roleToRevoke);
                $this->dispatchBrowserEvent('updated', ['title' => "Role {$this->roleToRevoke} berhasil dihapus", 'icon' => 'success', 'iconColor' => 'green']);
                $this->reset('roleToRevoke');
            } catch (\Exception $e) {
                $this->dispatchBrowserEvent('updated', ['title' => "Role gagal dihapus", 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
    }

    /**
     * addRole of user
     *
     * @return void
     */
    public function addRole()
    {
        if (!userHasPermission(PERMISSION_UPDATE_AKSES_ADMIN))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menambah role dari user ini', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            if ($this->roleToAdd) {
                try {
                    $this->user->assignRole($this->roleToAdd);
                    $this->dispatchBrowserEvent('updated', ['title' => "Role {$this->roleToAdd} berhasil ditambahkan", 'icon' => 'success', 'iconColor' => 'green']);
                    $this->reset('roleToAdd');
                } catch (\Exception $e) {
                    $this->dispatchBrowserEvent('updated', ['title' => "Role gagal ditambahkan", 'icon' => 'error', 'iconColor' => 'red']);
                }
            } else
                $this->dispatchBrowserEvent('updated', ['title' => "Silakan pilih role", 'icon' => 'error', 'iconColor' => 'red']);
        }
    }

    public function render()
    {
        // Ambil semua role yang ada dan role dari user
        $allRoles = ModelsRole::all();
        $this->userRoles = $this->user->getRoleNames();

        // Hanya mengambil role yang belum dimiliki oleh user
        $this->roles = $allRoles->filter(function ($r, $key) {
            return !$this->userRoles->contains($r->name);
        });

        return view('admin.maba.user.detail.role', [
            'roles' => $this->roles,
            'userRole' => $this->userRoles
        ]);
    }
}
