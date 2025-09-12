<?php

namespace App\Livewire\Admin\Informasi\Formulir\Detail;

use App\Models\User;
use Livewire\Component;
use App\Models\Formulir;
use App\Models\Kelompok;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use App\Models\FormulirVerification;
use App\Services\GoogleSheetService;
use Livewire\Attributes\On;

class Show extends Component
{
    use WithPagination;

    public $formulir;
    public $search;
    public $status = 0;
    public $kelompokSearch = '%%';

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
        if (!userHasPermission(PERMISSION_DELETE_FORMULIR_VERIFICATION)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk menghapus data', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $user = User::find($userId);
            
            if (!$user) {
                $this->dispatch('updated', 
                    title: 'User tidak ditemukan', 
                    icon: 'error', 
                    iconColor: 'red'
                );
                return;
            }

            $deleted = FormulirVerification::where('nimb', $user->nimb)
                ->where('formulir_id', $this->formulir->id)
                ->delete();

            if ($deleted) {
                $this->dispatch('verificationDeleted', 
                    userId: $userId,
                    nimb: $user->nimb
                );
                
                $this->dispatch('refreshDetailFormulir');
                
                $this->dispatch('updated', 
                    title: "Data {$user->name} berhasil dihapus", 
                    icon: 'success', 
                    iconColor: 'green'
                );
            } else {
                $this->dispatch('updated', 
                    title: 'Data tidak ditemukan untuk dihapus', 
                    icon: 'warning', 
                    iconColor: 'yellow'
                );
            }
            
        } catch (\Throwable $th) {
            \Log::error('Delete FormulirVerification Error: ' . $th->getMessage(), [
                'user_id' => $userId,
                'formulir_id' => $this->formulir->id,
                'auth_user_id' => auth()->id()
            ]);
            
            $this->dispatch('updated', 
                title: 'Gagal menghapus data', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    public function ubahStatus($userId)
    {
        if (!userHasPermission(PERMISSION_UPDATE_FORMULIR_VERIFICATION)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk mengubah status', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $user = User::find($userId);
            
            if (!$user) {
                $this->dispatch('updated', 
                    title: 'User tidak ditemukan', 
                    icon: 'error', 
                    iconColor: 'red'
                );
                return;
            }

            // Check if already exists to prevent duplicates
            $exists = FormulirVerification::where('nimb', $user->nimb)
                ->where('formulir_id', $this->formulir->id)
                ->exists();

            if ($exists) {
                $this->dispatch('updated', 
                    title: 'Data sudah ada dalam formulir ini', 
                    icon: 'warning', 
                    iconColor: 'yellow'
                );
                return;
            }

            FormulirVerification::create([
                'nimb' => $user->nimb,
                'formulir_id' => $this->formulir->id,
            ]);
            
            $this->dispatch('verificationCreated', 
                userId: $userId,
                nimb: $user->nimb
            );
            
            $this->dispatch('refreshDetailFormulir');
            
            $this->dispatch('updated', 
                title: "Status {$user->name} berhasil diubah", 
                icon: 'success', 
                iconColor: 'green'
            );
            
        } catch (\Throwable $th) {
            \Log::error('Update FormulirVerification Error: ' . $th->getMessage(), [
                'user_id' => $userId,
                'formulir_id' => $this->formulir->id,
                'auth_user_id' => auth()->id()
            ]);
            
            $this->dispatch('updated', 
                title: 'Gagal mengubah status', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    #[On('refreshDetailFormulir')]
    public function refresh()
    {
        // Magic method $refresh() sekarang menjadi method explicit
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
