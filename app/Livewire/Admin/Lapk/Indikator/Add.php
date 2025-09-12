<?php

namespace App\Livewire\Admin\Lapk\Indikator;

use App\Models\Indikator;
use Livewire\Component;

class Add extends Component
{
    public $isModalOpen = false;
    public $nama;
    public $dimensi;
    public $sks;
    public $detail;

    /**
     * resetAll input
     *
     * @return void
     */
    public function resetAll()
    {
        $this->reset('nama', 'isModalOpen', 'dimensi', 'sks', 'detail');
        $this->resetValidation();
    }

    /**
     * submit new indikator
     *
     * @return void
     */
public function submit()
{
    $this->validate([
        'nama' => 'required',
        'dimensi' => 'required',
        'sks' => 'required|numeric|min:1|max:4'
    ]);

    if (!userHasPermission(PERMISSION_ADD_INDIKATOR_PENILAIAN)) {
        $this->dispatch('updated', 
            title: 'Kamu tidak memiliki akses untuk menambah indikator penilaian', 
            icon: 'error', 
            iconColor: 'red'
        );
        return;
    }

    try {
        Indikator::create([
            'nama' => $this->nama,
            'dimensi' => $this->dimensi,
            'sks' => $this->sks,
            'detail' => $this->detail
        ]);
        
        $this->dispatch('updated', 
            title: 'Berhasil menambahkan indikator', 
            icon: 'success', 
            iconColor: 'green'
        );
        
        $this->dispatch('refreshIndikatorAdmin');
        
        // Reset only on success
        $this->resetAll();
        
    } catch (\Throwable $th) {
        $this->dispatch('updated', 
            title: 'Gagal menambahkan indikator', 
            icon: 'error', 
            iconColor: 'red'
        );
    }
}


    public function render()
    {
        return view('admin.lapk.indikator.add');
    }
}
