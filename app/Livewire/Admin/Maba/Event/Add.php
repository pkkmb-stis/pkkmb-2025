<?php

namespace App\Livewire\Admin\Maba\Event;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Str;

class Add extends Component
{
    public $title;
    public $eventcode;
    public $caption;
    public $link;
    public $link_lambat;
    public $is_pasca;
    public $waktu_akhir;
    public $waktu_mulai;
    public $isModalOpen = false;

    protected $rules = [
        'title' => 'required',
        'caption' => 'required',
        'is_pasca' => 'required',
        'waktu_mulai' => 'required|date_format:Y-m-d H:i:s',
        'waktu_akhir' => 'required|date_format:Y-m-d H:i:s|after:waktu_mulai',
    ];

    /**
     * closeModal add event and reset all input
     *
     * @return void
     */
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->reset('title', 'caption', 'link', 'is_pasca', 'waktu_akhir', 'waktu_mulai', 'link_lambat');
        $this->resetValidation();
    }

    /**
     * add new event
     *
     * @return void
     */
public function submit()
{
    $this->validate();

    if (!userHasPermission(PERMISSION_ADD_EVENT)) {
        $this->dispatch('updated', 
            title: 'Kamu tidak memiliki akses untuk menambah acara absensi', 
            icon: 'error', 
            iconColor: 'red'
        );
        return;
    }

    try {
        Event::create([
            'title' => $this->title,
            'eventcode' => Str::random(30),
            'caption' => $this->caption,
            'category' => CATEGORY_EVENT_PRESENSI,
            'link' => $this->link,
            'is_pasca' => $this->is_pasca,
            'waktu_akhir' => $this->waktu_akhir,
            'waktu_mulai' => $this->waktu_mulai,
            'link_lambat' => $this->link_lambat
        ]);

        $this->dispatch('updated', 
            title: 'Berhasil Menambahkan Acara', 
            icon: 'success', 
            iconColor: 'green'
        );
        
        $this->dispatch('reloadHalamanAbsensi');
        
        // Close modal only on success
        $this->closeModal();
        
    } catch (\Exception $e) {
        $this->dispatch('updated', 
            title: $e->getMessage(), 
            icon: 'error', 
            iconColor: 'red'
        );
    }
}


    public function render()
    {
        return view('admin.maba.event.add');
    }
}
