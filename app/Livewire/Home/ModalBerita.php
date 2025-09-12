<?php

namespace App\Livewire\Home;

use App\Models\Berita;
use Livewire\Component;
use Livewire\Attributes\On;

class ModalBerita extends Component
{
    public $berita;
    public $showModalBerita = false;

    #[On('openModalBeritaHarian')]
    public function openModalBeritaHarian(Berita $berita)
    {
        $this->berita = $berita;
        $this->showModalBerita = true;
    }

    public function render()
    {
        return view('home.modal-berita');
    }
}
