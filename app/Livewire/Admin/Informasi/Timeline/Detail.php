<?php

namespace App\Livewire\Admin\Informasi\Timeline;

use App\Models\Event;
use Livewire\Component;
use Livewire\Attributes\On;

class Detail extends Component
{
    public $showModalDetail = false, $canUpdate;
    public $title, $caption, $waktuMulai, $waktuAkhir, $location, $link_gallery, $timeline;

    /**
     * dijalankan pertama, untuk mengecek apakah user bisa mengedit timeline
     *
     * @return void
     */
    public function mount()
    {
        $this->canUpdate = userHasPermission(PERMISSION_UPDATE_TIMELINE);
    }

    /**
     * openDetailTimeline modal
     *
     * @param  mixed $timeline
     * @return void
     */
    #[On('openDetailTimeline')]
    public function openDetailTimeline(Event $timeline)
    {
        $this->resetValidation();
        $this->timeline = $timeline;
        $this->title = $timeline->title;
        $this->caption = $timeline->caption;
        $this->waktuMulai = $timeline->waktu_mulai;
        $this->waktuAkhir = $timeline->waktu_akhir;
        $this->location = $timeline->location;
        $this->link_gallery = $timeline->link_gallery;
        $this->showModalDetail = true;
    }

    /**
     * update timeline
     *
     * @return void
     */
    public function update()
    {
        $this->validate([
            'title' => 'required',
            'waktuMulai' => 'required',
            'location' => 'required',
        ]);

        // Jika waktu akhirnya ada maka pastikan lebih dari waktu awal
        if ($this->waktuAkhir) {
            $this->validate(['waktuAkhir' => 'after:waktuMulai']);
        }

        if (!userHasPermission(PERMISSION_UPDATE_TIMELINE)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk mengubah timeline', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $this->timeline->update([
                'title' => $this->title,
                'caption' => $this->caption,
                'waktu_mulai' => $this->waktuMulai,
                'waktu_akhir' => $this->waktuAkhir ? $this->waktuAkhir : null,
                'location' => $this->location,
                'link_gallery' => $this->link_gallery,
            ]);
            
            $this->dispatch('updated', 
                title: 'Berhasil mengubah timeline', 
                icon: 'success', 
                iconColor: 'green'
            );
            
            $this->dispatch('refreshAdminTimeline');
            $this->showModalDetail = false;
            
        } catch (\Throwable $th) {
            \Log::error('Update Timeline Error: ' . $th->getMessage());
            
            $this->dispatch('updated', 
                title: 'Gagal mengubah timeline', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    public function render()
    {
        return view('admin.informasi.timeline.detail');
    }
}
