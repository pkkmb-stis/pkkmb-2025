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

    // Properti untuk form edit & detail
    public $jenispoin, $poin, $alasan, $urutan_input, $tanggal_poin, $image, $filename;
    public $jenisPoinSelected;
    public $selected;
    public $poinToShow;
    public $jenispoins;
    public $canChangeJenisPoin = true;
    public $selected_day_edit;
    public $tanggal_edit_manual; // <-- Nilai untuk input tanggal manual di modal

    // Properti untuk kontrol UI (modal, filter, search)
    public $openedit = false;
    public $showModalDetail = false;
    public $search;
    public $jenisUser = "semua";
    public $tipePoin = -1; // -1 berarti semua tipe poin
    public $editDateMode = 'dropdown'; // <-- Mode untuk modal edit: 'dropdown' atau 'manual'
    
    // Properti untuk filter tabel
    public $selected_day_poin;
    public $filterDateMode = 'dropdown';

    protected $listeners = ['reloadTableInputPoin' => '$refresh'];

    /**
     * Hook untuk mereset input tanggal filter tabel saat mode diubah.
     */
    public function updatedFilterDateMode()
    {
        $this->reset('selected_day_poin', 'tanggal_poin');
    }

    /**
     * Hook untuk mereset input tanggal modal edit saat mode diubah.
     */
    public function updatedEditDateMode()
    {
        $this->reset('selected_day_edit', 'tanggal_edit_manual');
    }

    /**
     * Dijalankan sekali saat komponen dimuat.
     */
    public function mount()
    {
        $this->jenispoins = JenisPoin::whereIn('category', [CATEGORY_JENISPOIN_PENGHARGAAN, CATEGORY_JENISPOIN_PELANGGARAN, CATEGORY_JENISPOIN_PENEBUSAN])
            ->orderBy('category', 'asc')
            ->orderBy('nama', 'asc')
            ->get();
    }

    /**
     * Mengisi nilai poin & alasan secara otomatis saat jenis poin diubah.
     */
    public function updatedJenispoin($jenispoin)
    {
        $this->jenisPoinSelected = JenisPoin::find($jenispoin % 1000);
        $this->poin = $this->jenisPoinSelected->poin;
        $this->alasan = $this->jenisPoinSelected->alasan_template;
    }

    /**
     * Menyiapkan data dan membuka modal untuk proses edit.
     */
    public function edit(Poin $poin)
    {
        $this->selected = $poin;
        $this->jenispoin = $poin->jenis_poin_id;
        $this->jenisPoinSelected = JenisPoin::find($this->jenispoin);
        $this->urutan_input = $poin->urutan_input;
        $this->alasan = $poin->alasan;
        $this->poin = $poin->poin;
        $this->filename = $poin->filename;
        
        // Reset state modal edit tanggal setiap kali dibuka
        $this->reset('selected_day_edit', 'tanggal_edit_manual', 'editDateMode');

        if ($this->jenisPoinSelected != null && $this->jenisPoinSelected->category == CATEGORY_JENISPOIN_PENEBUSAN) {
            $this->canChangeJenisPoin = false;
        } else {
            $this->canChangeJenisPoin = true;
        }

        $this->openedit = true;
    }

    /**
     * Memvalidasi dan menyimpan perubahan data poin ke database.
     */
    public function update()
    {
        if (!userHasPermission(PERMISSION_UPDATE_POIN)) {
            $this->dispatchBrowserEvent('updated', [ 'title' => 'Kamu tidak memiliki akses untuk update poin', 'icon' => 'error', 'iconColor' => 'red' ]);
            return;
        }

        if ($this->jenisPoinSelected != null && $this->jenisPoinSelected->category == CATEGORY_JENISPOIN_PELANGGARAN) {
            $this->validate([ 'poin' => 'required|numeric', 'alasan' => 'nullable|max:500', 'jenispoin' => 'required|numeric', 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' ]);
            if ($this->image != null) {
                if ($this->selected->filename) {
                    Storage::disk('public')->delete('images/bukti-poin/' . $this->selected->filename);
                }
                $this->filename = sha1(uniqid(mt_rand(), true)) . '.' . $this->image->getClientOriginalExtension();
                $this->image->storeAs('images/bukti-poin', $this->filename, 'public');
            }
        } else {
            $this->validate([ 'poin' => 'required|numeric', 'alasan' => 'nullable|max:500', 'jenispoin' => 'required|numeric' ]);
            if ($this->selected->filename) {
                Storage::disk('public')->delete('images/bukti-poin/' . $this->selected->filename);
            }
            $this->filename = null;
        }
        
        try {
            // Logika baru untuk menentukan tanggal poin berdasarkan mode di modal edit
            $urutanInput = $this->urutan_input;
            $originalTime = \Carbon\Carbon::parse($this->urutan_input)->format('H:i:s');

            if ($this->editDateMode === 'dropdown' && $this->selected_day_edit) {
                $dayDate = Day::getDateByName($this->selected_day_edit);
                if ($dayDate) {
                    $urutanInput = $dayDate->format('Y-m-d') . ' ' . $originalTime;
                }
            } 
            elseif ($this->editDateMode === 'manual' && $this->tanggal_edit_manual) {
                $urutanInput = $this->tanggal_edit_manual . ' ' . $originalTime;
            }

            $data = [
                'poin' => $this->poin,
                'urutan_input' => $urutanInput,
                'alasan' => $this->alasan,
                'jenis_poin_id' => $this->jenispoin % 1000,
                'filename' => $this->filename
            ];

            $this->selected->update($data);
            $this->dispatchBrowserEvent('updated', [ 'title' => 'Berhasil mengedit poin', 'icon' => 'success', 'iconColor' => 'green' ]);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('updated', ['title' => 'Gagal mengedit poin', 'icon' => 'error', 'iconColor' => 'red']);
        }
        $this->resetAll();
    }

    public function resetAll()
    {
        $this->reset('search', 'selected', 'jenispoin', 'alasan', 'poin', 'urutan_input', 'image', 'selected_day_edit', 'openedit', 'editDateMode', 'tanggal_edit_manual');
    }

    public function show(Poin $poin)
    {
        $this->poinToShow = $poin->load('user', 'jenispoin');
        $this->showModalDetail = true;
    }

    public function destroy(Poin $poin)
    {
        if (!userHasPermission(PERMISSION_DELETE_POIN)) {
            return $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menghapus poin', 'icon' => 'error', 'iconColor' => 'red']);
        }
        
        try {
            if ($poin->filename && Storage::disk('public')->exists('images/bukti-poin/' . $poin->filename)) {
                Storage::disk('public')->delete('images/bukti-poin/' . $poin->filename);
            }
            $poin->delete();
            $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menghapus poin', 'icon' => 'success', 'iconColor' => 'green']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menghapus poin', 'icon' => 'error', 'iconColor' => 'red']);
        }
    }

    public function updating($name, $value)
    {
        $this->resetPage();
    }

    private function getPoins($search, $date)
    {
        $poins = Poin::with(['user', 'jenispoin']);

        $poins->whereHas('user', function (Builder $query) use ($search) {
            if ($this->jenisUser == 'panitia') {
                $query->role(ROLE_PANITIA);
            }
            if ($this->jenisUser == 'maba') {
                $query->has('kelompok');
            }
            if ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', $search)
                        ->orWhere('username', 'like', $search)
                        ->orWhere('nimb', 'like', $search);
                });
            }
        });

        if ($date) {
            $poins->where('urutan_input', 'like', $date);
        }

        if ($this->tipePoin != -1){
            $poins->whereHas('jenispoin', function (Builder $query) {
                $query->where('category', '=', $this->tipePoin);
            });
        }

        $poins->orderBy('urutan_input', 'desc');
        return $poins->paginate(NUMBER_OF_PAGINATION);
    }

    public function render()
    {
        $tanggal_filter = null;
        
        if ($this->filterDateMode === 'dropdown') {
            if ($this->selected_day_poin) {
                $dayDate = Day::getDateByName($this->selected_day_poin);
                if ($dayDate) {
                    $tanggal_filter = $dayDate->format('Y-m-d');
                }
            }
        } elseif ($this->filterDateMode === 'manual') {
            if ($this->tanggal_poin) {
                $tanggal_filter = $this->tanggal_poin;
            }
        }

        $date = $tanggal_filter ? $tanggal_filter . '%' : null;
        $search = $this->search ? '%' . $this->search . '%' : null;

        return view('admin.maba.poin.table', ['poins' => $this->getPoins($search, $date)]);
    }

    /**
     * Mereset filter tanggal.
     */
    public function resetFilter()
    {
        $this->reset('selected_day_poin', 'tanggal_poin');
    }
}