<?php

namespace App\Http\Livewire\Admin\Maba\Poin;

use App\Models\Poin\JenisPoin;
use App\Models\Poin\Poin;
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

    public $selected;
    public $openedit = false;
    public $search;
    public $poinToShow;
    public $jenisUser = "semua"; // maba dan panitia
    public $tipePoin = -1; // semua tipe poin
    public $showModalDetail = false;
    public $jenispoins;
    public $canChangeJenisPoin = true;

    protected $listeners = ['reloadTableInputPoin' => '$refresh'];

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
            } else {
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
                $data = [
                    'poin' => $this->poin,
                    'urutan_input' => $this->urutan_input,
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
        $this->reset('search', 'selected', 'jenispoin', 'alasan', 'poin', 'urutan_input', 'image');
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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingJenisUser()
    {
        $this->resetPage();
    }

    public function updatingTipePoin()
    {
        $this->resetPage();
    }

    public function updatingTanggalPoin()
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

        // filter jenis poin
        $poins->whereHas('jenispoin', function (Builder $query) use ($date, $search) {
            if ($this->tipePoin != -1)
                $query->where('category', '=', $this->tipePoin);

            $query->where('urutan_input', 'like', $date);
        });

        $poins->orderBy('urutan_input', 'desc');
        return $poins->paginate(NUMBER_OF_PAGINATION);
    }

    public function render()
    {
        $tanggal = $this->tanggal_poin == '' ? date('Y-m-d', time()) : $this->tanggal_poin;
        $this->tanggal_poin = $tanggal;

        $date = $tanggal . "%";
        $search = '%' . $this->search . '%';
        return view('admin.maba.poin.table', ['poins' => $this->getPoins($search, $date)]);
    }
}
