<?php

namespace App\Livewire\Admin\Informasi\Timeline;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Show extends Component
{
    use WithPagination;

    public $timelineDetail;
    public $search;

    /**
     * hapus timeline
     *
     * @param  mixed $timeline
     * @return void
     */
    public function hapus(Event $timeline)
    {
        if (!userHasPermission(PERMISSION_DELETE_TIMELINE)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk menghapus timeline', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $timeline->delete();
            
            $this->dispatch('updated', 
                title: 'Berhasil menghapus timeline', 
                icon: 'success', 
                iconColor: 'green'
            );
            
        } catch (\Throwable $th) {
            $this->dispatch('updated', 
                title: 'Gagal menghapus timeline', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    #[On('refreshAdminTimeline')]
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
        return view('admin.informasi.timeline.show', [
            'timeline' =>  Event::timeline()->where('title', 'like', $search)->paginate(NUMBER_OF_PAGINATION)
        ]);
    }
}
