<?php

namespace App\Http\Livewire\Admin\Informasi\Timeline;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $timelineDetail;
    public $search;

    protected $listeners = ['refreshAdminTimeline' => '$refresh'];

    /**
     * hapus timeline
     *
     * @param  mixed $timeline
     * @return void
     */
    public function hapus(Event $timeline)
    {
        if (!userHasPermission(PERMISSION_DELETE_TIMELINE))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menghapus timeline', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                $timeline->delete();
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menghapus timeline', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menghapus timeline', 'icon' => 'error', 'iconColor' => 'red']);
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
        return view('admin.informasi.timeline.show', [
            'timeline' =>  Event::timeline()->where('title', 'like', $search)->paginate(NUMBER_OF_PAGINATION)
        ]);
    }
}
