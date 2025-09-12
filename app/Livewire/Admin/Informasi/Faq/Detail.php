<?php

namespace App\Livewire\Admin\Informasi\Faq;

use App\Models\Faq;
use Livewire\Component;
use Livewire\Attributes\On;

class Detail extends Component
{
    public $showModalDetail = false, $canUpdate;
    public $pertanyaan, $jawaban, $faq;

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
    #[On('openDetailFaq')]
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

        if (!userHasPermission(PERMISSION_UPDATE_FAQ)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk mengubah FAQ', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $this->faq->update([
                'pertanyaan' => $this->pertanyaan,
                'jawaban' => $this->jawaban,
            ]);
            
            $this->dispatch('updated', 
                title: 'Berhasil mengubah FAQ', 
                icon: 'success', 
                iconColor: 'green'
            );
            
            $this->dispatch('refreshAdminFaq');
            $this->showModalDetail = false;
            
        } catch (\Throwable $th) {
            \Log::error('Update FAQ Error: ' . $th->getMessage(), [
                'faq_id' => $this->faq->id,
                'user_id' => auth()->id()
            ]);
            
            $this->dispatch('updated', 
                title: 'Gagal mengubah FAQ', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    public function render()
    {
        return view('admin.informasi.faq.detail');
    }
}
