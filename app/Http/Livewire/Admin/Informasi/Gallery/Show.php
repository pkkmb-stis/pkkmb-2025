<?php

namespace App\Http\Livewire\Admin\Informasi\Gallery;

use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $category  = CATEGORY_GALLERY_FOTO;
    public $inHome = 0;
    public $title;
    public $tipe;

    protected $listeners = ['refreshAdminGallery'];

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingInHome()
    {
        $this->resetPage();
    }

    public function updatingTitle()
    {
        $this->resetPage();
    }

    /**
     * refresh tabel gallery
     *
     * @param  mixed $category
     * @return void
     */
    public function refreshAdminGallery($category)
    {
        $this->category = $category;
        $this->inHome = 0;
        $this->resetPage();
    }

    /**
     * getGallery berdasarkan filter
     *
     * @return void
     */
    private function getGallery()
    {
        // Tentukan tipe query berdasarkan kategori
        $query = $this->category == CATEGORY_GALLERY_FOTO ? Gallery::foto() : Gallery::video();
        $this->tipe = getCategoryGallery($this->category);

        // Atur pencarian berdasarkan kategori
        $search = '%' . $this->title . '%';
        if ($this->category == CATEGORY_GALLERY_FOTO) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', $search)
                    ->orWhereHas('event', function ($q) use ($search) {
                        $q->where('title', 'like', $search);
                    });
            });
        } else {
            $query->where('title', 'like', $search);
        }

        // Filter jika inHome diaktifkan
        if ($this->inHome != 0) {
            $query->where('urutan', '!=', null)->orderBy('urutan');
        }

        // Kembalikan hasil paginasi
        return $query->orderBy('created_at', 'desc')->paginate(NUMBER_OF_PAGINATION);
    }


    /**
     * hapus gallery
     *
     * @param  mixed $gallery
     * @return void
     */
    public function hapus(Gallery $gallery)
    {
        if (!userHasPermission(PERMISSION_DELETE_GALLERY))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk delete gallery', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                // jika foto maka hapus filenya di storage terlebih dahulu
                if ($gallery->category == CATEGORY_GALLERY_FOTO)
                    Storage::delete($gallery->getAttributes()['filename']);
                $gallery->delete();

                $this->dispatchBrowserEvent('updated', ['title' => "Berhasil menghapus " . $this->tipe, 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => "Gagal menghapus " . $this->tipe, 'icon' => 'success', 'iconColor' => 'green']);
            }
        }
    }

    public function render()
    {
        return view('admin.informasi.gallery.show', [
            'gallery' => $this->getGallery()
        ]);
    }
}
