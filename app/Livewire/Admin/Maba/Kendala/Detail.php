<?php

namespace App\Livewire\Admin\Maba\Kendala;

use App\Models\Kendala;
use Livewire\Component;
use App\Events\PengaduanUpdated;
use Livewire\Attributes\On;

class Detail extends Component
{
    public $showDetailKendala = false;
    public $kendala, $status, $tanggapan;
    public $canEdit;

    /**
     * listener untuk membuka modal edit/detail
     *
     * @param  mixed $kendala
     * @return void
     */
    #[On('openDetailKendalaAdmin')]
    public function openDetailKendalaAdmin(Kendala $kendala)
    {
        $this->kendala = $kendala;
        $this->status = $kendala->status;
        $this->tanggapan = $kendala->tanggapan;
        $this->showDetailKendala = true;
        $this->canEdit = userHasPermission(PERMISSION_UPDATE_KENDALA);
    }

    /**
     * resetAll input
     *
     * @return void
     */
    public function resetAll()
    {
        $this->reset('showDetailKendala', 'kendala', 'status', 'tanggapan');
    }

    /**
     * ubah kendala
     *
     * @return void
     */
    public function ubah()
    {
        if (!$this->canEdit) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk mengubah kendala', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $this->kendala->update([
                'status' => $this->status,
                'tanggapan' => $this->tanggapan
            ]);
            
            $countPengaduan = Kendala::where('status', 0)->count();
            event(new PengaduanUpdated($countPengaduan, 'update'));
            
            $this->dispatch('updated', 
                title: "Perubahan berhasil disimpan", 
                icon: 'success', 
                iconColor: 'green'
            );
            
            $this->dispatch('refreshHalamanKendala');
            
            // Reset only on success
            $this->resetAll();
            
        } catch (\Throwable $th) {
            $this->dispatch('updated', 
                title: "Perubahan gagal disimpan", 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    public function render()
    {
        return view('admin.maba.kendala.detail');
    }
}
