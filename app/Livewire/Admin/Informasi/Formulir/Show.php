<?php

namespace App\Livewire\Admin\Informasi\Formulir;

use Livewire\Component;
use App\Models\Formulir;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Show extends Component
{
    use WithPagination;

    public $search;

    public function hapus(Formulir $formulir)
    {
        if (!userHasPermission(PERMISSION_DELETE_FORMULIR)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk menghapus Formulir', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $formulirName = $formulir->nama_formulir; // Store before deletion
            $formulir->delete();
            
            $this->dispatch('updated', 
                title: "Berhasil menghapus formulir '{$formulirName}'", 
                icon: 'success', 
                iconColor: 'green'
            );
            
        } catch (\Throwable $th) {
            \Log::error('Delete Formulir Error: ' . $th->getMessage(), [
                'formulir_id' => $formulir->id,
                'user_id' => auth()->id()
            ]);
            
            $this->dispatch('updated', 
                title: 'Gagal menghapus Formulir', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    #[On('refreshAdminFormulir')]
    public function refresh()
    {
        // Magic method $refresh() sekarang menjadi method explicit
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('admin.informasi.formulir.show', [
            'formulirs' => Formulir::where('nama_formulir', 'like', $search)
                ->paginate(NUMBER_OF_PAGINATION)
        ]);
    }
}
