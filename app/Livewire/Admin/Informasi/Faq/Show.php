<?php

namespace App\Livewire\Admin\Informasi\Faq;

use App\Models\Faq;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Show extends Component
{
    use WithPagination;

    public $faqDetail;
    public $search;

    /**
     * hapus FAQ
     *
     * @param  mixed $faq
     * @return void
     */
    public function hapus(Faq $faq)
    {
        if (!userHasPermission(PERMISSION_DELETE_FAQ)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk menghapus FAQ', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $faqQuestion = $faq->pertanyaan; // Store before deletion
            $faq->delete();
            
            $this->dispatch('updated', 
                title: 'Berhasil menghapus FAQ', 
                icon: 'success', 
                iconColor: 'green'
            );
            
        } catch (\Throwable $th) {
            \Log::error('Delete FAQ Error: ' . $th->getMessage(), [
                'faq_id' => $faq->id,
                'user_id' => auth()->id()
            ]);
            
            $this->dispatch('updated', 
                title: 'Gagal menghapus FAQ', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    #[On('refreshAdminFaq')]
    public function refresh()
    {
        // Magic method $refresh() sekarang menjadi method explicit
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('admin.informasi.faq.show', [
            'faqs' => Faq::where('pertanyaan', 'like', $search)
                ->orWhere('jawaban', 'like', $search)
                ->paginate(NUMBER_OF_PAGINATION)
        ]);
    }
}
