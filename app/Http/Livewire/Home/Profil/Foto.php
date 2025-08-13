<?php

namespace App\Http\Livewire\Home\Profil;

use Livewire\Component;

class Foto extends Component
{
    protected $listeners = ['refreshPhotoNavbar' => '$refresh'];

    //  ini ebenarnya cuman komponen foto profil yang diheader, sengaja dibuat pakai livewire agar ketika foto diganti foto yang di navbra bisa juga langsung diubah tanpa harus refresh halaman
    public function render()
    {
        return view('home.profil.foto');
    }
}
