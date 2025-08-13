<?php

namespace App\Http\Livewire\Home;

use App\Models\Berita;
use Livewire\Component;

class ModalBerita extends Component
{
    public $berita;
    public $showModalBerita = false;
    protected $listeners = ['openModalBeritaHarian'];

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
