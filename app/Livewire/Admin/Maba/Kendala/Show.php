<?php

namespace App\Livewire\Admin\Maba\Kendala;

use App\Models\Kendala;
use Livewire\Component;
use Livewire\WithPagination;
use App\Events\PengaduanUpdated;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

class Show extends Component
{
    use WithPagination;

    public $status = -1;
    public $category = -1;
    public $search;

    /**
     * hapus kendala
     *
     * @param  mixed $kendala
     * @return void
     */
    public function hapus(Kendala $kendala)
    {
        if (!userHasPermission(PERMISSION_DELETE_KENDALA)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk menghapus kendala', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            // hapus semua fotonya
            if ($kendala->foto_kendala) Storage::delete($kendala->foto_kendala);
            if ($kendala->foto_atribute) Storage::delete($kendala->foto_atribute);
            if ($kendala->foto_perlengkapan) Storage::delete($kendala->foto_perlengkapan);
            
            $kendala->delete();

            $countPengaduan = Kendala::where('status', 0)->count();
            event(new PengaduanUpdated($countPengaduan, 'delete'));
            
            $this->dispatch('updated', 
                title: 'Berhasil menghapus kendala', 
                icon: 'success', 
                iconColor: 'green'
            );
            
        } catch (\Throwable $th) {
            $this->dispatch('updated', 
                title: 'Gagal menghapus kendala', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    #[On('refreshHalamanKendala')]
    public function refresh()
    {
        // Magic method $refresh() sekarang menjadi method explicit
    }

    #[On('pengaduanUpdated')]
    public function refreshKendalaTable()
    {
        $this->resetPage(); // Opsional, ini untuk mereset pagination ke halaman pertama
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    /**
     * getKendala sesuai filter
     *
     * @return void
     */
    private function getKendala($search)
    {
        $query = Kendala::whereHas('user', function ($query) use ($search) {
            $query->where('name', 'like', $search)
                ->orWhere('username', 'like', $search)
                ->orWhere('nimb', 'like', $search);
        });

        if ($this->category != -1) $query = $query->where('category', $this->category);
        if ($this->status != -1) $query = $query->where('status', $this->status);
        return $query->orderBy('created_at', 'desc')->paginate(NUMBER_OF_PAGINATION);
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('admin.maba.kendala.show', [
            'kendala' => $this->getKendala($search)
        ]);
    }
}
