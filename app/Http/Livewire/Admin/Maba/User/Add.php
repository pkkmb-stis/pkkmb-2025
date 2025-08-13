<?php

namespace App\Http\Livewire\Admin\Maba\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Add extends Component
{
    public $nama;
    public $email;
    public $password;
    public $nim;
    public $isModalOpen = false;

    protected $rules = [
        'nim' => 'required',
        'nama' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
    ];

    /**
     * resetAll
     *
     * @return void
     */
    private function resetAll()
    {
        $this->reset('nama', 'email', 'password', 'nim');
    }

    /**
     * closeModal add user
     *
     * @return void
     */
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetAll();
        $this->resetValidation();
    }

    /**
     * add new user
     *
     * @return void
     */
    public function submit()
    {
        $this->validate();
        if (!userHasPermission(PERMISSION_ADD_USER))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menambahkan user', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                User::create([
                    'username' => $this->nim,
                    'name' => $this->nama,
                    'email' => $this->email,
                    'password' => Hash::make(md5($this->password))
                ]);

                $this->closeModal();
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil Menambahkan User', 'icon' => 'success', 'iconColor' => 'green']);
                $this->emit('reloadUserPage');
            } catch (\Exception $e) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal Menambahkan User', 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
    }

    public function render()
    {
        return view('admin.maba.user.add');
    }
}
