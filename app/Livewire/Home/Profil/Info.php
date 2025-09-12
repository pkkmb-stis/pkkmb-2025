<?php

namespace App\Livewire\Home\Profil;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Info extends Component
{
    use WithFileUploads;

    public $user;
    public $kelompok;
    public $photo;

    /**
     * mount, ambil data yang diperlukan
     *
     * @return void
     */
    public function mount()
    {
        $this->user = auth()->user()->load('kelompok');
        if ($this->user->kelompok)
            $this->kelompok = $this->user->kelompok->load('pendamping');
    }

    /**
     * updatedPhoto profile
     *
     * @return void
     */
    public function updatedPhoto()
    {
        $this->validate(['photo' => 'image|max:2048']);

        $fotoLama = $this->user->profile_photo_path;
        // jika ada upload foto maka hapus foto yang lama
        if ($fotoLama)
            Storage::delete($fotoLama);

        $fotoBaru = $this->photo->store('photo-profile');
        $this->user->update(['profile_photo_path' => $fotoBaru]);

        $this->dispatch('updated', 
            title: 'Berhasil mengubah foto profil', 
            icon: 'success', 
            iconColor: 'green'
        );

        // refresh component foto profile di navbar
        $this->dispatch('refreshPhotoNavbar');
    }

    public function render()
    {
        // cek ada errorya ga, kalau ada tampilin menggunakan toast manual
        if (count($this->getErrorBag()->all()) > 0) {
            $this->dispatch('updated', 
                title: 'Gagal mengubah foto. Pastikan file merupakan file gambar dan tidak lebih dari 2MB', 
                icon: 'error', 
                iconColor: 'red'
            );
            $this->resetValidation();
        }
        return view('home.profil.info');
    }

}
