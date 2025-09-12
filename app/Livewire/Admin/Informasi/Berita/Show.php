<?php

namespace App\Livewire\Admin\Informasi\Berita;

use App\Models\Berita;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $search;
    public $isPublished = -1;


    /**
     * hapus berita harian
     *
     * @return void
     */
public function hapus(Berita $berita)
{
    if (!userHasPermission(PERMISSION_DELETE_BERITA)) {
        $this->dispatch('updated', 
            title: 'Kamu tidak memiliki akses untuk menghapus berita', 
            icon: 'error', 
            iconColor: 'red'
        );
        return;
    }

    $thumbnailPath = $berita->thumbnails;

    try {
        // Delete record first
        $berita->delete();
        
        // Delete file only if record deletion successful
        if ($thumbnailPath && Storage::exists($thumbnailPath)) {
            Storage::delete($thumbnailPath);
        }
        
        $this->dispatch('updated', 
            title: 'Berhasil menghapus berita', 
            icon: 'success', 
            iconColor: 'green'
        );
        
        $this->dispatch('reloadBeritaPage');
        
    } catch (\Exception $e) {
        \Log::error('Delete Berita Error: ' . $e->getMessage(), [
            'berita_id' => $berita->id,
            'user_id' => auth()->id()
        ]);
        
        $this->dispatch('updated', 
            title: 'Gagal menghapus berita', 
            icon: 'error', 
            iconColor: 'red'
        );
    }
}


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingIsPublished()
    {
        $this->resetPage();
    }

    /**
     * getBerita berdasarkan filter
     *
     * @return void
     */
    private function getBerita()
    {
        $query = Berita::where(function ($query) {
            $search = '%' . $this->search . '%';
            $query->where('judul', 'like', $search)
                ->orWhere('published_by', 'like', $search);
        });

        // berita yang sudah dipublish adalah materi yang publish datetimenya lebih kecil dari waktu sekarang
        if ($this->isPublished == 1) {
            $query = $query->where('published_datetime', '<=', DB::raw(rawSQLDateTime()));
        } else if ($this->isPublished == 0) {
            $query = $query->where('published_datetime', '>', DB::raw(rawSQLDateTime()));
        }

        return   $query->orderBy('published_datetime', 'desc')
            ->paginate(NUMBER_OF_PAGINATION);
    }


    public function render()
    {
        return view('admin.informasi.berita.show', ['berita' => $this->getBerita()]);
    }
}
