<?php

namespace App\Http\Livewire\Admin\Informasi\Formulir;

use Livewire\Component;
use App\Models\Formulir;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $search;

    protected $listeners = ['refreshAdminFormulir' => '$refresh'];

    public function hapus(Formulir $formulir)
    {
        if (!userHasPermission(PERMISSION_DELETE_FORMULIR))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menghapus Formulir', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                $formulir->delete();
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menghapus Formulir', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menghapus Formulir', 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
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
