<?php

namespace App\Http\Livewire\Admin\Informasi\Faq;

use App\Models\Faq;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $faqDetail;
    public $search;

    protected $listeners = ['refreshAdminFaq' => '$refresh'];

    /**
     * hapus FAQ
     *
     * @param  mixed $faq
     * @return void
     */
    public function hapus(Faq $faq)
    {
        if (!userHasPermission(PERMISSION_DELETE_FAQ))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menghapus FAQ', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                $faq->delete();
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menghapus FAQ', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menghapus FAQ', 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
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
