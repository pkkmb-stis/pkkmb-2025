<?php

namespace App\Livewire\Admin\Informasi\Gallery;

use App\Models\Event;
use App\Models\Gallery;
use Livewire\Component;
use Livewire\WithFileUploads;


class Add extends Component
{
    use WithFileUploads;

    public $isModalOpen = false;
    public $category, $title, $file, $link, $caption, $urutan = 0, $event_id;
    public $events;

    /**
     * resetAll input
     *
     * @return void
     */
    public function resetAll()
    {
        $this->reset('category', 'title', 'file', 'link', 'caption', 'urutan', 'event_id', 'isModalOpen');
        $this->resetValidation();
    }

    public function mount()
    {
        // Ambil hanya events dengan kategori 2 (Timeline)
        $this->events = Event::where('category', CATEGORY_EVENT_TIMELINE)->get();
    }

    /**
     * real time validation when category changed
     *
     * @return void
     */
    public function updatedCategory()
    {
        // variabel link untuk menyimpan link youtube sedangkan file untuk menyimpan file foto
        if ($this->category == CATEGORY_GALLERY_VIDEO) $this->reset('link');
        else if ($this->category == CATEGORY_GALLERY_FOTO) $this->reset('file');
        else $this->reset('link', 'file');
    }

    /**
     * realtime validation when upload file
     *
     * @return void
     */
    public function updatedFile()
    {
        if ($this->file)
            $this->validate([
                'file' => 'image|max:2048'
            ]);
    }

    /**
     * add new gallery
     *
     * @return void
     */
public function submit()
{
    if (!userHasPermission(PERMISSION_ADD_GALLERY)) {
        $this->dispatch('updated', 
            title: 'Kamu tidak memiliki akses untuk menambah gallery', 
            icon: 'error', 
            iconColor: 'red'
        );
        return;
    }

    $this->validate([
        'title' => 'required',
        'category' => 'required',
    ]);

    // validasi sesuai dengan jenis gallery
    if ($this->category == CATEGORY_GALLERY_VIDEO) {
        $this->validate([
            'link' => 'required',
            'urutan' => 'numeric'
        ]);
        $link = $this->link;
    } else if ($this->category == CATEGORY_GALLERY_FOTO) {
        $this->validate([
            'file' => 'image|max:2048',
            'event_id' => 'required|exists:events,id'
        ]);
        $link = $this->file->store('gallery');
    }

    try {
        Gallery::create([
            'category' => $this->category,
            'title' => $this->title,
            'filename' => $link,
            'caption' => $this->caption,
            'urutan' => $this->urutan == 0 ? null : $this->urutan,
            'event_id' => $this->event_id
        ]);

        $this->dispatch('updated', 
            title: 'Berhasil menambahkan ' . getCategoryGallery($this->category), 
            icon: 'success', 
            iconColor: 'green'
        );
        
        $this->dispatch('refreshAdminGallery', category: $this->category);
        
    } catch (\Throwable $th) {
        $this->dispatch('updated', 
            title: "Gagal menambah " . getCategoryGallery($this->category), 
            icon: 'error', 
            iconColor: 'red'
        );
    }
    
    $this->resetAll();
}


    public function render()
    {
        return view('admin.informasi.gallery.add', [
            'events' => $this->events // Kirimkan $events ke view
        ]);
    }
}
