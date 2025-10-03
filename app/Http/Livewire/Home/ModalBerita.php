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

    /**
     * FUNGSI BARU UNTUK MENUTUP MODAL
     * Metode ini akan dipanggil oleh wire:click dari frontend.
     */
    public function closeBerita()
    {
        $this->showModalBerita = false;
        // Reset properti $berita agar bersih saat modal dibuka lagi
        $this->reset('berita');
    }

    public function render()
    {
        return view('home.modal-berita');
    }
}