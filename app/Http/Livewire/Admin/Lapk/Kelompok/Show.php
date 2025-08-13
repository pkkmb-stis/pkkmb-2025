<?php

namespace App\Http\Livewire\Admin\Lapk\Kelompok;

use App\Models\Kelompok;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    private $kelompok;
    protected $listeners = ['reloadPageKelompok' => 'reload'];
    public $search;


    /**
     * method to listed event reloadPageKelompok
     *
     * @return void
     */
    public function reload()
    {
        $this->reset('search');
    }

    /**
     * removeKelompok
     *
     * @param  mixed $id
     * @return void
     */
    public function removeKelompok($id)
    {
        if (!userHasPermission(PERMISSION_DELETE_KELOMPOK))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menghapus kelompok', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                Kelompok::find($id)->delete();
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menghapus kelompok', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menghapus kelompok', 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
    }

    /**
     * Lifecycle hook untuk reset pagination ketika pencarian atau kategori berubah
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategorySelected()
    {
        $this->resetPage();
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        $this->kelompok = Kelompok::with('pendamping')
            ->where('nama', 'like', $search)
            ->orWhereHas('pendamping', function ($query) use ($search) {
                $query->where('name', 'like', $search);
            })
            ->orderby('created_at', 'desc')
            ->withCount('anggota')
            ->paginate(NUMBER_OF_PAGINATION);

        return view('admin.lapk.kelompok.show', ['kelompok' => $this->kelompok]);
    }
}
