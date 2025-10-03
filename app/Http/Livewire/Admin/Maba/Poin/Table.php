<?php

namespace App\Http\Livewire\Admin\Maba\Poin;

use App\Models\Poin\JenisPoin;
use App\Models\Poin\Poin;
use App\Models\Day;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Table extends Component
{
    use WithPagination, WithFileUploads;
    public $jenispoin, $poin, $alasan, $urutan_input, $tanggal_poin, $image, $filename;
    public $jenisPoinSelected;
    public $selected_day_poin;
    public $selected_day_edit;
    public $selected;
    public $openedit = false;
    public $search;
    public $poinToShow;
    public $jenisUser = "semua";
    public $tipePoin = -1; // semua tipe poin
    public $showModalDetail = false;
    public $jenispoins;
    public $canChangeJenisPoin = true;

    // ==================== PERUBAHAN 1.1 (TAMBAHKAN INI) ====================
    public $filterDateMode = 'dropdown'; // 'dropdown' atau 'manual'
    // =======================================================================

    protected $listeners = ['reloadTableInputPoin' => '$refresh'];

    // ==================== PERUBAHAN 1.2 (TAMBAHKAN INI) ====================
    public function updatedFilterDateMode()
    {
        $this->reset('selected_day_poin', 'tanggal_poin');
    }
    // =======================================================================

    public function mount()
    {
        $this->jenispoins = JenisPoin::whereIn('category', [CATEGORY_JENISPOIN_PENGHARGAAN, CATEGORY_JENISPOIN_PELANGGARAN, CATEGORY_JENISPOIN_PENEBUSAN])
            ->orderBy('category', 'asc')
            ->orderBy('nama', 'asc')
            ->get();
    }

    public function updatedJenispoin($jenispoin)
    {
        $this->jenisPoinSelected = JenisPoin::find($jenispoin % 1000);
        $this->poin = $this->jenisPoinSelected->poin;
        $this->alasan = $this->jenisPoinSelected->alasan_template;
    }

    public function edit(Poin $poin)
    {
        $this->selected = $poin;
        $this->jenispoin = $poin->jenis_poin_id;
        $this->jenisPoinSelected = JenisPoin::find($this->jenispoin);
        $this->urutan_input = $poin->urutan_input;
        $this->alasan = $poin->alasan;
        $this->poin = $poin->poin;
        $this->filename = $poin->filename;
        $this->selected_day_edit = null;

        // cek kalau jenis poinnya penebusan maka tidak bisa diubah tipenya
        if ($this->jenisPoinSelected != null && $this->jenisPoinSelected->category == CATEGORY_JENISPOIN_PENEBUSAN)
            $this->canChangeJenisPoin = false;
        else
            $this->canChangeJenisPoin = true;

        $this->openedit = true;
    }

    public function update()
    {
        if (!userHasPermission(PERMISSION_UPDATE_POIN))
            $this->dispatchBrowserEvent('updated', [
                'title' => 'Kamu tidak memiliki akses untuk update poin',
                'icon' => 'error',
                'iconColor' => 'red'
            ]);
        else {
            if ($this->jenisPoinSelected != null && $this->jenisPoinSelected->category == CATEGORY_JENISPOIN_PELANGGARAN) {
                $this->validate([
                    'poin' => 'required|numeric',
                    'alasan' => 'nullable|max:500',
                    'jenispoin' => 'required|numeric',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
                if ($this->image != null) {
                    Storage::disk('public')->delete('images/bukti-poin/' . $this->selected->filename);
                    $this->filename = sha1(uniqid(mt_rand(), true)) . '.' . $this->image->getClientOriginalExtension();
                    $this->image->storeAs('images/bukti-poin', $this->filename, 'public');
                }
            } 
            
            else {
                $this->validate([
                    'poin' => 'required|numeric',
                    'alasan' => 'nullable|max:500',
                    'jenispoin' => 'required|numeric',
                ]);
                if ($this->image != null) {
                    Storage::disk('public')->delete('images/bukti-poin/' . $this->selected->filename);
                }
                $this->filename = null;
            }
            
            try {
                // NEW: Convert selected_day_edit to actual datetime if selected
                $urutanInput = $this->urutan_input;
                if ($this->selected_day_edit) {
                    $dayDate = Day::getDateByName($this->selected_day_edit);
                    if ($dayDate) {
                        // Preserve original time, change only the date
                        $originalTime = \Carbon\Carbon::parse($this->urutan_input)->format('H:i:s');
                        $urutanInput = $dayDate->format('Y-m-d') . ' ' . $originalTime;
                    }
                }

                $data = [
                    'poin' => $this->poin,
                    'urutan_input' => $urutanInput,
                    'alasan' => $this->alasan,
                    'jenis_poin_id' => $this->jenispoin % 1000,
                    'filename' => $this->filename
                ];

                $this->selected->update($data);

                $this->dispatchBrowserEvent('updated', [
                    'title' => 'Berhasil mengedit poin',
                    'icon' => 'success',
                    'iconColor' => 'green'
                ]);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal mengedit poin', 'icon' => 'error', 'iconColor' => 'red']);
            }
            $this->resetAll();
        }
    }

    public function resetAll()
    {
        $this->reset('search', 'selected', 'jenispoin', 'alasan', 'poin', 'urutan_input', 'image', 'selected_day_edit', 'openedit');
    }

    public function show(Poin $poin)
    {
        $this->poinToShow = $poin->load('user', 'jenispoin');
        $this->showModalDetail = true;
    }

    public function destroy(Poin $poin)
    {
        if (!userHasPermission(PERMISSION_DELETE_POIN))
            return $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menambah poin', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                if ($poin->filename && \Storage::disk('public')->exists('images/bukti-poin/' . $poin->filename)) {
                    \Storage::disk('public')->delete('images/bukti-poin/' . $poin->filename);
                }
                $poin->delete();
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menghapus poin', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menghapus poin', 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
    }

    public function updating($name, $value)
    {
        $this->resetPage();
    }

    private function getPoins($search, $date)
    {
        // Melakukan pencarian berdasarkan nama dan username
        $poins = Poin::with(['user', 'jenispoin']);

        // filter jenis user
        $poins->whereHas('user', function (Builder $query) use ($search) {
            if ($this->jenisUser == 'panitia')
                $query->role(ROLE_PANITIA);

            if ($this->jenisUser == 'maba')
                $query->has('kelompok');

            // filter pencarian nama atau username
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', $search)
                    ->orWhere('username', 'like', $search)
                    ->orWhere('nimb', 'like', $search);
            });
        });

        if ($date) {
            $poins->where('urutan_input', 'like', $date);
        }

        // filter jenis poin
        $poins->whereHas('jenispoin', function (Builder $query) {
            if ($this->tipePoin != -1){
                $query->where('category', '=', $this->tipePoin);
            }
        });

        $poins->orderBy('urutan_input', 'desc');
        return $poins->paginate(NUMBER_OF_PAGINATION);
    }

    public function render()
    {
        $tanggal_filter = null;

        // ==================== PERUBAHAN 1.3 (UBAH BLOK INI) ====================
        // Sebelumnya:
        // if ($this->selected_day_poin) { ... } elseif ($this->tanggal_poin) { ... }
        
        // Menjadi:
        if ($this->filterDateMode === 'dropdown') {
            if ($this->selected_day_poin) {
                $dayDate = Day::getDateByName($this->selected_day_poin);
                if ($dayDate) {
                    $tanggal_filter = $dayDate->format('Y-m-d');;
                }
            }
        } elseif ($this->filterDateMode === 'manual') {
            if ($this->tanggal_poin) {
                $tanggal_filter = $this->tanggal_poin;
            }
        }

        $date = $tanggal_filter ? $tanggal_filter . '%' : null;
        $search = '%' . $this->search . '%';

        return view('admin.maba.poin.table', ['poins' => $this->getPoins($search, $date)]);
    }

    /**
     * Reset filter method
     */
    public function resetFilter()
    {
        $this->selected_day_poin = null;
        $this->tanggal_poin = null;
    }

}

