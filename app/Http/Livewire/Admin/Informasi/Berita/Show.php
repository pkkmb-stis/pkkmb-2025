<?php

namespace App\Http\Livewire\Admin\Informasi\Berita;

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
        if (!userHasPermission(PERMISSION_DELETE_BERITA))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menghapus berita', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                Storage::delete($berita->thumbnails);
                $berita->delete();
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil Menghapus Berita', 'icon' => 'success', 'iconColor' => 'green']);
                $this->emit('reloadBeritaPage');
            } catch (\Exception $e) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal Menghapus Berita', 'icon' => 'error', 'iconColor' => 'red']);
            }
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
