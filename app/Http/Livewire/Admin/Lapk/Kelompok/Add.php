<?php

namespace App\Http\Livewire\Admin\Lapk\Kelompok;

use App\Models\Kelompok;
use App\Models\User;
use Livewire\Component;

class Add extends Component
{
    private $users;

    public $selectedUser;
    public $search;
    public $nama;
    public $pendamping;
    public $isModalOpen = false;

    /**
     * selectUser to add
     *
     * @param  mixed $user
     * @return void
     */
    public function selectUser($user = null)
    {
        if ($user) $this->search = $user['name'];
        else $this->search = '';

        $this->selectedUser = $user;
    }

    /**
     * add new kelompok
     *
     * @return void
     */
    public function addKelompok()
    {
        $this->pendamping = $this->selectedUser['id'] ?? null;
        $this->validate([
            'nama' => 'required',
            'pendamping' => 'required'
        ]);

        if (!userHasPermission(PERMISSION_ADD_KELOMPOK))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menambah kelompok', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                Kelompok::create([
                    'nama' => $this->nama,
                    'lapk_user_id' => $this->pendamping
                ]);

                $this->emit('reloadPageKelompok');
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menambahkan kelompok', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menambahkan kelompok', 'icon' => 'success', 'iconColor' => 'green']);
            }
            $this->reset('search', 'nama', 'pendamping', 'isModalOpen');
        }
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        $this->users = User::where('kelompok_id', null)
            ->where('name', 'like', $search)
            ->limit(5)
            ->get();

        return view('admin.lapk.kelompok.add', [
            'users' => $this->users
        ]);
    }
}
