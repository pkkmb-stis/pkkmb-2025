<?php

namespace App\Livewire\Admin\Informasi\Faq;

use App\Models\Faq;
use Livewire\Component;

class Add extends Component
{
    public $showModalAdd = false;
    public $pertanyaan, $jawaban;

    /**
     * resetAll input
     *
     * @return void
     */
    public function resetAll()
    {
        $this->reset('pertanyaan', 'jawaban', 'showModalAdd');
    }

    /**
     * add new FAQ
     *
     * @return void
     */
public function submit()
{
    $this->validate([
        'pertanyaan' => 'required',
        'jawaban' => 'required'
    ]);

    if (!userHasPermission(PERMISSION_ADD_FAQ)) {
        $this->dispatch('updated', 
            title: 'Kamu tidak memiliki akses untuk menambah FAQ', 
            icon: 'error', 
            iconColor: 'red'
        );
        return;
    }

    try {
        Faq::create([
            'pertanyaan' => $this->pertanyaan,
            'jawaban' => $this->jawaban,
        ]);
        
        $this->dispatch('updated', 
            title: 'Berhasil menambah FAQ', 
            icon: 'success', 
            iconColor: 'green'
        );
        
        $this->dispatch('refreshAdminFaq');
        
        // Reset only on success
        $this->resetAll();
        
    } catch (\Throwable $th) {
        \Log::error('Add FAQ Error: ' . $th->getMessage(), [
            'user_id' => auth()->id(),
            'pertanyaan' => $this->pertanyaan
        ]);
        
        $this->dispatch('updated', 
            title: 'Gagal menambahkan FAQ', 
            icon: 'error', 
            iconColor: 'red'
        );
    }
}


    public function render()
    {
        return view('admin.informasi.faq.add');
    }
}
