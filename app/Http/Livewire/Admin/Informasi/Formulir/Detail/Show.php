<?php

namespace App\Http\Livewire\Admin\Informasi\Formulir\Detail;

use App\Models\User;
use Livewire\Component;
use App\Models\Formulir;
use App\Models\Kelompok;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use App\Models\FormulirVerification;
use App\Services\GoogleSheetService;


class Show extends Component
{
    use WithPagination;

    public $formulir;
    public $search;
    public $status = 0;
    public $kelompokSearch = '%%';

    protected $listeners = ['refreshDetailFormulir' => '$refresh'];

    public function mount(Formulir $formulir)
    {
        $this->formulir = $formulir;
    }

    public function updating($propertyName)
    {
        if (in_array($propertyName, ['search', 'status', 'kelompokSearch'])) {
            $this->resetPage();
        }
    }

    public function hapus($userId)
    {
        $user = User::find($userId);

        if ($user) {
            FormulirVerification::where('nimb', $user->nimb)
                ->where('formulir_id', $this->formulir->id)
                ->delete();
            $this->emit('refreshDetailFormulir'); // Emit event untuk me-refresh tabel
            $this->dispatchBrowserEvent('updated', ['title' => "Data berhasil dihapus", 'icon' => 'success', 'iconColor' => 'green']);
        }
    }

    public function ubahStatus($userId)
    {
        $user = User::find($userId);

        if ($user) {
            FormulirVerification::create([
                'nimb' => $user->nimb,
                'formulir_id' => $this->formulir->id,
            ]);
            $this->emit('refreshDetailFormulir'); // Emit event untuk me-refresh tabel
            $this->dispatchBrowserEvent('updated', ['title' => "Status berhasil diubah", 'icon' => 'success', 'iconColor' => 'green']);
        }
    }


    public function render()
    {
        $kelompok = Kelompok::all()->pluck('nama');
        $query = User::whereNotNull('nimb');

        if ($this->status == 0) {
            $query->whereDoesntHave('formulirVerifications', function ($query) {
                $query->where('formulir_id', $this->formulir->id);
            });
        } elseif ($this->status == 1) {
            $query->whereHas('formulirVerifications', function ($query) {
                $query->where('formulir_id', $this->formulir->id);
            });
        }

        // Apply kelompok filter
        if ($this->kelompokSearch !== '%%') {
            $query->whereHas('kelompok', function ($q) {
                $q->where('nama', 'like', '%' . $this->kelompokSearch . '%');
            });
        }

        $users = $query->where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('username', 'like', '%' . $this->search . '%')
                ->orWhere('nimb', 'like', '%' . $this->search . '%');
        })
            ->paginate(NUMBER_OF_PAGINATION);

        return view('admin.informasi.formulir.detail.show', [
            'users' => $users,
            'kelompok' => $kelompok
        ]);
    }
}
