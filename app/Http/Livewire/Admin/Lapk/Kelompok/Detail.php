<?php

namespace App\Http\Livewire\Admin\Lapk\Kelompok;

use App\Models\Kelompok;
use App\Models\User;
use Livewire\Component;

class Detail extends Component
{
    public $kelompok;
    public $search;
    public $users;
    public $selectedUser;

    public $nama;
    public $linkWa;
    public $linkZoom;
    public $linkClassroom;
    public $jenisKelompok;
    public $warnaCoCard;
    public $deskripsi;
    public $canAddDeleteAnggota;
    public $canUpdateKelompok;

    /**
     * initiate data to edit
     *
     * @return void
     */
    public function mount()
    {
        $this->nama = $this->kelompok->nama;
        $this->linkWa = $this->kelompok->link_group_wa;
        $this->linkZoom = $this->kelompok->link_zoom;
        $this->linkClassroom = $this->kelompok->link_classroom;
        $this->deskripsi = $this->kelompok->description;
        $this->jenisKelompok = $this->kelompok->jenis_kelompok;
        $this->warnaCoCard = $this->kelompok->warna_co_card;

        // Cek apakah user adalah pendamping kelompok ini
        $user = auth()->user();
        $handleThisKelompok = $user->handleKelompok->pluck('id')->contains($this->kelompok->id);

        // Yang bisa melakukan update aggota adalah yang memiliki add delete anggota permission atau LAPK yang menghandle kelompok ini
        $this->canAddDeleteAnggota = $user->can(PERMISSION_ADD_DELETE_ANGGOTA_KELOMPOK) || $handleThisKelompok;

        // Yang bisa melakukan update informasi kelompok adalah yang memiliki update permission atau LAPK yang menghandle kelompok ini
        $this->canUpdateKelompok = $user->can(PERMISSION_UPDATE_KELOMPOK) || $handleThisKelompok;
    }

    /**
     * selectUser that want to add in this kelompok
     *
     * @param  mixed $user
     * @return void
     */
    public function selectUser($user)
    {
        $this->selectedUser = $user;
        $this->search = $user['name'];
    }

    /**
     * clean search and selected user
     *
     * @return void
     */
    public function removeSearch()
    {
        $this->reset('selectedUser', 'search');
    }

    /**
     * reload variabel kelompok after add or remove anggota
     *
     * @return void
     */
    private function reloadAnggota()
    {
        $this->kelompok = Kelompok::find($this->kelompok->id);
    }

    /**
     * add new anggota
     *
     * @return void
     */
    public function addAnggota()
    {
        if (!$this->canAddDeleteAnggota)
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menambah anggota kelompok', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            if ($this->selectedUser) {
                try {
                    User::doesntHave('kelompok')
                        ->find($this->selectedUser['id'])
                        ->update(['kelompok_id' => $this->kelompok->id]);

                    $this->reloadAnggota();
                    $this->removeSearch();
                    $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menambahkan anggota', 'icon' => 'success', 'iconColor' => 'green']);
                } catch (\Throwable $th) {
                    $this->dispatchBrowserEvent('updated', ['title' => 'User sudah masuk dikelompok lain', 'icon' => 'error', 'iconColor' => 'red']);
                }
            } else
                $this->dispatchBrowserEvent('updated', ['title' => 'Silakan pilih anggota', 'icon' => 'error', 'iconColor' => 'red']);
        }
    }

    /**
     * remove anggota from this kelompok
     *
     * @param  mixed $id
     * @return void
     */
    public function removeAnggota($id)
    {
        if (!$this->canAddDeleteAnggota)
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menghapus anggota kelompok', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                User::find($id)
                    ->update(['kelompok_id' => null]);

                $this->reloadAnggota();
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menghapus anggota', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menghapus anggota', 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
    }

    /**
     * update data kelompok
     *
     * @return void
     */
    public function updateKelompok()
    {
        $this->validate([
            'nama' => 'required',
            'jenisKelompok' => 'required',
        ]);
        if (!$this->canUpdateKelompok)
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk mengupdate informasi kelompok', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                $this->kelompok->update([
                    'nama' => $this->nama,
                    'link_group_wa' => $this->linkWa,
                    'link_zoom' => $this->linkZoom,
                    'link_classroom' => $this->linkClassroom,
                    'description' => $this->deskripsi,
                    'jenis_kelompok' => $this->jenisKelompok,
                    'warna_co_card' => $this->warnaCoCard,
                ]);
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil mengupdate kelompok', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal mengupdate kelompok', 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        $this->users = User::doesntHave('handleKelompok')
            ->doesntHave('kelompok')
            ->where('name', 'like', $search)
            ->limit(5)
            ->get();

        return view('admin.lapk.kelompok.detail', ['users' => $this->users]);
    }
}
