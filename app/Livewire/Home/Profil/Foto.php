<?php

namespace App\Livewire\Home\Profil;

use Livewire\Component;
use Livewire\Attributes\On;

class Foto extends Component
{
    #[On('refreshPhotoNavbar')]
    public function refresh()
    {
        // Magic method $refresh() sekarang menjadi method explicit
    }

    //  ini ebenarnya cuman komponen foto profil yang diheader, sengaja dibuat pakai livewire agar ketika foto diganti foto yang di navbra bisa juga langsung diubah tanpa harus refresh halaman
    public function render()
    {
        return view('home.profil.foto');
    }
}
