<?php

namespace App\Livewire\Admin\Lapk\Indikator;

use App\Models\Indikator;
use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    public $openModal = false;
    public $nama;
    public $dimensi;
    public $sks;
    public $id_indikator;
    public $detail;
    public $canEdit;

    /**
     * toggleModal detail/edit indikator
     *
     * @return void
     */
    public function toggleModal()
    {
        $this->openModal = !$this->openModal;
    }

    /**
     * yang pertama kali dijalanin untuk mengecek apakah user bisa update penilaian atau hanya show detail aja
     *
     * @return void
     */
    public function mount()
    {
        $this->canEdit  = userHasPermission(PERMISSION_UPDATE_INDIKATOR_PENILAIAN);
    }

    /**
     * ambil data yang akan diedit
     *
     * @param  mixed $indikator
     * @return void
     */
    public function setField(Indikator $indikator)
    {
        $this->nama = $indikator->nama;
        $this->dimensi = $indikator->dimensi;
        $this->sks = $indikator->sks;
        $this->detail = $indikator->detail;
        $this->id_indikator = $indikator->id;
        $this->toggleModal();
    }

    /**
     * hapus indikator penilaian
     *
     * @param  mixed $indikator
     * @return void
     */
    public function hapus(Indikator $indikator)
    {
        if (!userHasPermission(PERMISSION_DELETE_INDIKATOR_PENILAIAN)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk menghapus indikator penilaian', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $indikator->delete();
            
            $this->dispatch('updated', 
                title: "Berhasil menghapus indikator", 
                icon: 'success', 
                iconColor: 'green'
            );
            
        } catch (\Throwable $th) {
            $this->dispatch('updated', 
                title: 'Gagal menghapus indikator', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    /**
     * ubahIndikator penilaian
     *
     * @return void
     */
    public function ubahIndikator()
    {
        $this->validate([
            'nama' => 'required',
            'dimensi' => 'required',
            'sks' => 'required|numeric|min:1|max:4'
        ]);

        if (!$this->canEdit) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk update indikator penilaian', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $indikator = Indikator::find($this->id_indikator);
            
            if (!$indikator) {
                $this->dispatch('updated', 
                    title: 'Indikator tidak ditemukan', 
                    icon: 'error', 
                    iconColor: 'red'
                );
                return;
            }

            $indikator->update([
                'nama' => $this->nama,
                'dimensi' => $this->dimensi,
                'sks' => $this->sks,
                'detail' => $this->detail
            ]);
            
            $this->dispatch('updated', 
                title: "Berhasil mengubah indikator", 
                icon: 'success', 
                iconColor: 'green'
            );
            
            $this->toggleModal();
            
        } catch (\Throwable $th) {
            $this->dispatch('updated', 
                title: "Gagal mengubah indikator", 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    #[On('refreshIndikatorAdmin')]
    public function refresh()
    {
        // Magic method $refresh() sekarang menjadi method explicit
    }

    public function render()
    {
        return view('admin.lapk.indikator.show', ['indikator' => Indikator::orderBy('dimensi')->orderBy('nama')->get()]);
    }
}
