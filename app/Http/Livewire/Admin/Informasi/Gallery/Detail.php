<?php

namespace App\Http\Livewire\Admin\Informasi\Gallery;

use App\Models\Event;
use App\Models\Gallery;
use Livewire\Component;

class Detail extends Component
{
    public $showDetailGallery = false;
    public $canUpdate;
    public $gallery, $filename, $caption, $title, $urutan, $event_id;
    public $events;

    protected $listeners = ['openDetailGallery'];

    public function mount()
    {
        $this->canUpdate = userHasPermission(PERMISSION_UPDATE_GALLERY);
    }

    /**
     * open modal detail gallery
     *
     * @param  mixed $gallery
     * @return void
     */
    public function openDetailGallery(Gallery $gallery)
    {
        $this->gallery = $gallery;
        $this->filename = $gallery->filename;
        $this->caption = $gallery->caption;
        $this->title = $gallery->title;
        $this->urutan = $gallery->urutan ?? 0;
        $this->showDetailGallery = true;
        $this->event_id = $gallery->event_id;
        if ($gallery->category == CATEGORY_GALLERY_FOTO) {
            $this->events = Event::where('category', CATEGORY_EVENT_TIMELINE)->get();
        }

        $this->showDetailGallery = true;
    }

    /**
     * update gallery
     *
     * @return void
     */
    public function update()
    {
        $this->validate([
            'title' => 'required',
            'event_id' => 'nullable|exists:events,id'
        ]);

        if (!$this->canUpdate)
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk update gallery', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            // Cek jika yang diupdate video apakah linknya berubah. Jika gambar cukup gunakan link yang lama karena foto tidak bisa diganti untuk mengurangi kompleksitas
            if ($this->gallery->category == CATEGORY_GALLERY_VIDEO) {
                $this->validate([
                    'filename' => 'required',
                    'urutan' => 'numeric'
                ]);
                $link = $this->filename;
            } else
                $link = $this->gallery->getAttributes()['filename'];

            try {
                $this->gallery->update([
                    'filename' => $link,
                    'title' => $this->title,
                    'urutan' => $this->urutan == 0 ? null : $this->urutan,
                    'caption' => $this->caption,
                    'event_id' => $this->gallery->category == CATEGORY_GALLERY_FOTO ? $this->event_id : null
                ]);
                $this->dispatchBrowserEvent('updated', ['title' => "Berhasil update " . getCategoryGallery($this->gallery->category), 'icon' => 'success', 'iconColor' => 'green']);
                $this->emit('refreshAdminGallery', $this->gallery->category);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => "Gagal mengupdate " . getCategoryGallery($this->gallery->category), 'icon' => 'error', 'iconColor' => 'red']);
            }
            $this->showDetailGallery = false;
        }
    }

    public function render()
    {
        return view('admin.informasi.gallery.detail');
    }
}
