<?php

namespace App\Http\Livewire\Admin\Informasi\Faq;

use App\Models\Faq;
use Livewire\Component;

class Detail extends Component
{
    public $showModalDetail = false, $canUpdate;
    public $pertanyaan, $jawaban, $faq;

    protected $listeners = ['openDetailFaq'];

    /**
     * Dijalan pertama, untuk mengecek apakah user bisa mengedit FAQ
     *
     * @return void
     */
    public function mount()
    {
        $this->canUpdate = userHasPermission(PERMISSION_UPDATE_FAQ);
    }

    /**
     * openDetailFaq modal
     *
     * @param  mixed $faq
     * @return void
     */
    public function openDetailFaq(Faq $faq)
    {
        $this->resetValidation();
        $this->faq = $faq;
        $this->pertanyaan = $faq->pertanyaan;
        $this->jawaban = $faq->jawaban;
        $this->showModalDetail = true;
    }

    /**
     * update FAQ
     *
     * @return void
     */
    public function update()
    {
        $this->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required'
        ]);

        try {
            $this->faq->update([
                'pertanyaan' => $this->pertanyaan,
                'jawaban' => $this->jawaban,
            ]);
            $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil mengubah FAQ', 'icon' => 'success', 'iconColor' => 'green']);
            $this->emit('refreshAdminFaq');
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('updated', ['title' => 'Gagal mengubah FAQ', 'icon' => 'error', 'iconColor' => 'red']);
        }
        $this->showModalDetail = false;
    }

    public function render()
    {
        return view('admin.informasi.faq.detail');
    }
}
