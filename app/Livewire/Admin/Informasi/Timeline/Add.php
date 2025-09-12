<?php

namespace App\Livewire\Admin\Informasi\Timeline;

use App\Models\Event;
use Livewire\Component;

class Add extends Component
{
    public $showModalAdd = false;
    public $title, $caption, $waktuMulai, $waktuAkhir, $location, $link_gallery;

    /**
     * resetAll input
     *
     * @return void
     */
    public function resetAll()
    {
        $this->reset('title', 'caption', 'waktuMulai', 'waktuAkhir', 'location', 'link_gallery', 'showModalAdd');
    }

    /**
     * add new timeline
     *
     * @return void
     */
public function submit()
{
    $this->validate([
        'title' => 'required',
        'waktuMulai' => 'required',
        'location' => 'required'
    ]);

    if ($this->waktuAkhir) {
        $this->validate(['waktuAkhir' => 'after:waktuMulai']);
    }

    if (!userHasPermission(PERMISSION_ADD_TIMELINE)) {
        $this->dispatch('updated', 
            title: 'Kamu tidak memiliki akses untuk menambah timeline', 
            icon: 'error', 
            iconColor: 'red'
        );
        return;
    }

    try {
        Event::create([
            'title' => $this->title,
            'category' => CATEGORY_EVENT_TIMELINE,
            'caption' => $this->caption,
            'waktu_mulai' => $this->waktuMulai,
            'waktu_akhir' => $this->waktuAkhir,
            'location' => $this->location,
            'link_gallery' => $this->link_gallery,
        ]);
        
        $this->dispatch('updated', 
            title: 'Berhasil menambah timeline', 
            icon: 'success', 
            iconColor: 'green'
        );
        
        $this->dispatch('refreshAdminTimeline');
        
        // Reset only on success
        $this->resetAll();
        
    } catch (\Throwable $th) {
        $this->dispatch('updated', 
            title: 'Gagal menambahkan timeline', 
            icon: 'error', 
            iconColor: 'red'
        );
    }
}


    public function render()
    {
        return view('admin.informasi.timeline.add');
    }
}
