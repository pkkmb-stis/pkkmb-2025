<?php

namespace App\Livewire\Home\Dashboard\Kendala;

use App\Models\Kendala;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Events\PengaduanUpdated;

class Form extends Component
{
    use WithFileUploads;

    public $showModalKendala = false;
    public $countPengaduan;
    public $content, $waktuKendala, $category, $fotoKendala, $fotoAtribute, $fotoPerlengkapan, $konfirmasi;

    /**
     * resetAll inputan
     *
     * @return void
     */
    public function resetAll()
    {
        $this->reset('showModalKendala', 'content', 'waktuKendala', 'category', 'fotoKendala', 'fotoAtribute', 'fotoPerlengkapan');
        $this->resetValidation();
    }

    /**
     * validateFoto foto yang diinput, maksimal 2MB
     *
     * @param  mixed $foto
     * @return void
     */
    private function validateFoto($foto)
    {
        $this->validate([$foto => 'image|max:2048']);
    }

    /**
     * jika foto kendala diupload maka validasi fotonya
     *
     * @return void
     */
    public function updatedFotoKendala()
    {
        if ($this->fotoKendala)
            $this->validateFoto('fotoKendala');
    }

    /**
     * jika foto atribute diupload maka validasi fotonya
     *
     * @return void
     */
    public function updatedFotoAtribute()
    {
        if ($this->fotoAtribute)
            $this->validateFoto('fotoAtribute');
    }

    /**
     * jika foto perlengkapan diupload maka validasi fotonya
     *
     * @return void
     */
    public function updatedFotoPerlengkapan()
    {
        if ($this->fotoPerlengkapan)
            $this->validateFoto('fotoPerlengkapan');
    }

    /**
     * submit new kendala
     *
     * @return void
     */
    public function submit()
    {
        $this->validate([
            'content' => 'required',
            'category' => 'required|numeric',
            'waktuKendala' => 'required',
            'konfirmasi' => 'required',
        ]);

        try {
            // pindahkan foto fotonya
            if ($this->fotoKendala) $fotoKendala = $this->fotoKendala->store('kendala/kendala');
            if ($this->fotoAtribute) $fotoAtribute = $this->fotoAtribute->store('kendala/atribute');
            if ($this->fotoPerlengkapan) $fotoPerlengkapan = $this->fotoPerlengkapan->store('kendala/perlengkapan');

            Kendala::create([
                'user_id' => auth()->user()->id,
                'content' => $this->content,
                'category' => $this->category,
                'waktu_kendala' => $this->waktuKendala,
                'foto_kendala' => $fotoKendala ?? null,
                'foto_atribute' => $fotoAtribute ?? null,
                'foto_perlengkapan' => $fotoPerlengkapan ?? null,
            ]);

            $countPengaduan = Kendala::where('status', 0)->count();
            event(new PengaduanUpdated($countPengaduan, 'add'));
            $this->dispatch('updated', 
                title: "Kendala kamu berhasil dikirimkan ke panitia", 
                icon: 'success', 
                iconColor: 'green'
            );
            $this->dispatch('refreshListKendala');
        } catch (\Throwable $th) {
            $this->dispatch('updated', 
                title: "Gagal mengirimkan kendala. Silakan coba lagi", 
                icon: 'error', 
                iconColor: 'red'
            );
        }
        $this->resetAll();
    }


    public function render()
    {
        return view('home.dashboard.kendala.form');
    }
}
