<?php

namespace App\Http\Livewire\Admin\Administrator\Admin;

use App\Models\User;
use Livewire\Component;


class Add extends Component
{
    public $users, $search, $selectedUser = null;

    /**
     * add new admin
     *
     * @return void
     */
    public function addAdmin()
    {
        if (!userHasPermission(PERMISSION_ADD_ADMIN))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menambah admin', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                User::find($this->selectedUser['id'])->givePermissionTo(PERMISSION_AKSES_ADMIN);
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menambah admin', 'icon' => 'success', 'iconColor' => 'green']);
                $this->emit('reloadAdminPage');
            } catch (\Exception $error) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menambahkan admin', 'icon' => 'error', 'iconColor' => 'red']);
            }
            $this->reset('search', 'users', 'selectedUser');
        }
    }

    /**
     * selectUser to be admin in search
     *
     * @param  mixed $user
     * @return void
     */
    public function selectUser($user = null)
    {
        $this->selectedUser = $user;
        if ($user)
            $this->search = $user['name'];
        else
            $this->search = '';
    }

    public function render()
    {
        $search = '%' . $this->search . '%';

        // User yang tidak memiliki permission apapun dianggap belum sebagai admin, harusnya sih yang bukan admin yang belum memuliki permission akses-admin, tapi kayaknya querynya ribet. kayaknya yang sekarang udah cukup
        $this->users = User::doesntHave('permissions')
            ->where('name', 'like', $search)
            ->limit(5)
            ->get();
        return view('admin.administrator.admin.add');
    }
}
