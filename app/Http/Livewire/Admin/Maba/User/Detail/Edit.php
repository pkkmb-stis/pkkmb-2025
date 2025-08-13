<?php

namespace App\Http\Livewire\Admin\Maba\User\Detail;

use Livewire\Component;

class Edit extends Component
{
    public $user;
    public $state;
    public $canUpdateBasic;
    public $canUpdateTambahan;

    protected function rules()
    {
        return [
            'state.username' => 'required',
            'state.name' => 'required',
            'state.email' => 'required|email|unique:users,email,' . $this->user->id,
        ];
    }

    /**
     * add initial variabel
     *
     * @param  mixed $user
     * @return void
     */
    public function mount($user)
    {
        $this->user = $user;
        $this->state['name'] = $user->name;
        $this->state['username'] = $user->username;
        $this->state['email'] = $user->email;
        $this->state['nama_statistik'] = $user->nama_statistik;
        $this->state['status_kelulusan'] = $user->status_kelulusan;
        $this->state['nimb'] = $user->nimb;
        $this->state['jenis_kelamin'] = $user->jenis_kelamin;

        $user = auth()->user();
        $this->canUpdateBasic = $user->can(PERMISSION_UPDATE_INFO_BASIC_USER);

        // Cek jika user yang login adalah pendamping maka cek apakah user akan dilihat detailnya merupakan maba bimbingannya
        if ($this->user->is_maba && $user->isLapk())
            $mabaBimbingan = $user->handleKelompok->pluck('id')->contains($this->user->kelompok_id);
        else $mabaBimbingan = false;

        $this->canUpdateTambahan = $this->canUpdateBasic || $user->can(PERMISSION_UPDATE_INFO_TAMBAHAN_USER) || $mabaBimbingan;
    }

    /**
     * updateProfil
     *
     * @return void
     */
    public function updateProfil()
    {
        $this->validate();

        if ($this->canUpdateBasic || $this->canUpdateTambahan) {
            $this->user->name = $this->state['name'];
            $this->user->username = $this->state['username'];
            $this->user->email = $this->state['email'];
            $this->user->nama_statistik = $this->state['nama_statistik'];
            $this->user->status_kelulusan = $this->state['status_kelulusan'] ?? 0;
            $this->user->nimb = $this->state['nimb'];
            $this->user->jenis_kelamin = $this->state['jenis_kelamin'];

            try {
                $this->user->save();
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menyimpan perubahan', 'icon' => 'success', 'iconColor' => 'green']);
                $this->emit('refreshTabelNilai');
            } catch (\Exception $e) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menyimpan perubahan', 'icon' => 'error', 'iconColor' => 'red']);
            }
        } else
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk mengubah profil user ini', 'icon' => 'error', 'iconColor' => 'red']);
    }

    public function render()
    {
        return view('admin.maba.user.detail.edit');
    }
}
