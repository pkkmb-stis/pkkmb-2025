<?php

namespace App\Http\Livewire\Admin\Informasi\Faq;

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

        if (!userHasPermission(PERMISSION_ADD_FAQ))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menambah FAQ', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                Faq::create([
                    'pertanyaan' => $this->pertanyaan,
                    'jawaban' => $this->jawaban,
                ]);
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menambah FAQ', 'icon' => 'success', 'iconColor' => 'green']);
                $this->emit('refreshAdminFaq');
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menambahkan FAQ', 'icon' => 'error', 'iconColor' => 'red']);
            }

            $this->resetAll();
        }
    }

    public function render()
    {
        return view('admin.informasi.faq.add');
    }
}
