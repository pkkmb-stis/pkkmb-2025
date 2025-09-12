<?php

namespace App\Livewire\Admin\Tibum\Penebusan;

use App\Models\User;
use Livewire\Component;
use App\Models\Poin\Poin;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Poin\Penebusan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

class Table extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $jenispoin, $poin_id, $deadline, $poin, $status, $catatan;
    public $canEditDeadline = false;
    public $file;
    public $selected;
    public $openedit = false;
    public $search;
    public $penebusanToShow;
    public $showModalDetail = false;
    public $selectedTipe = -1;
    public $selectedStatus = -1;

    /**
     * resetAll input
     *
     * @return void
     */
    public function resetAll()
    {
        $this->reset('catatan', 'selected', 'jenispoin', 'deadline', 'file', 'poin_id', 'status', 'openedit', 'showModalDetail', 'canEditDeadline');
    }

    /**
     * untuk memunculkan modal edit, mengambil data penebusan yang sesuai
     *
     * @param  mixed $penebusan
     * @return void
     */
    public function edit(Penebusan $penebusan)
    {
        $penebusan->load(['jenispoin', 'user']);
        $this->selected = $penebusan;
        $this->jenispoin = $penebusan->jenispoin->nama;
        $this->poin = $penebusan->jenispoin->poin;
        $this->status = $penebusan->status;
        $this->deadline = $penebusan->deadline ?? null;

        // tidak akan bisa edit deadline kalau statusnya sedang dikoreksi dan sudah selesai, untuk menjaga konsistenan data
        if ($this->status == PENEBUSAN_MENUNGGU_UPLOAD || $this->status == PENEBUSAN_TERLAMBAT || $this->status == PENEBUSAN_BUTUH_REVISI)
            $this->canEditDeadline = true;

        $this->openedit = true;
    }

    /**
     * delete file penugasan penebusan
     *
     * @return void
     */
    private function deleteFile()
    {
        if (Storage::exists($this->selected->link)) {
            Storage::delete($this->selected->link);
        }
    }

    /**
     * delete poin yang berkaitan dengan penebusan
     *
     * @return void
     */
    private function deletePoin()
    {
        if ($this->selected && $this->selected->poin_id) {
            $poin_id = $this->selected->poin_id;
            $this->selected->update(['poin_id' => null]);
            DB::table('jenis_poin_user')->where('id', $poin_id)->delete();
        }
    }

    /**
     * perbaruiFile, file yang lama akan langsung dihapus
     *
     * @return void
     */
    private function perbaruiFile()
    {
        // cek kalau ada upload file baru maka perbarui filenya
        if ($this->file) {
            $user = User::find($this->selected->user_id);
            $fileName = $user->name . '_' . $user->username . '_' . now()->format('YmdHis') . '.';

            Storage::delete($this->selected->link);
            $file =  $this->file->storeAs('penebusan', $fileName . $this->file->extension());
        } else
            $file = $this->selected->link;
        return $file;
    }

    /**
     * mempersiapkan data sesuai dengan status penebusannya
     *
     * @param  mixed $status
     * @return void
     */
    private function logicStatus($status)
    {
        $data = [];

        if ($status == PENEBUSAN_BUTUH_REVISI) {
            $data['accepted_at'] = null;
            $data['submited_at'] = null;
            $this->deletePoin();
        }

        if ($status == PENEBUSAN_SEDANG_DIKOREKSI) {
            $data['link'] = $this->perbaruiFile();
        }

        if ($status == PENEBUSAN_SELESAI) {
            $data['accepted_at'] = now();
            $data['submited_at'] = $this->selected->submited_at ?? now();
            $data['link'] = $this->perbaruiFile();

            // Jika poinnya belum ada maka tambahkan poin baru
            if (!$this->selected->poin_id) {
                $newPoinId = DB::table('jenis_poin_user')->insertGetId([
                    'user_id' => $this->selected->user_id,
                    'jenis_poin_id' => $this->selected->jenis_poin_id,
                    'urutan_input' => now(),
                    'poin' => $this->poin,
                    'alasan' => "Telah menyelesaikan penugasan penebusan {$this->jenispoin}",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $data['poin_id'] = $newPoinId;
            } else {
                // Jika sebelumnya sudah ada maka ubah urutan inputnya menjadi sekarang
                DB::table('jenis_poin_user')
                    ->where('id', $this->selected->poin_id)
                    ->update(['urutan_input' => now()]);
            }
        }

        if ($status == PENEBUSAN_TERLAMBAT) {
            $data['accepted_at'] = null;
            $data['submited_at'] = null;
            $this->deletePoin();
        }

        if ($status == PENEBUSAN_MENUNGGU_UPLOAD) {
            $data['accepted_at'] = null;
            $data['submited_at'] = null;
            $this->deletePoin();
            $this->deleteFile(); // File hanya dihapus jika statusnya MENUNGGU_UPLOAD
            $data['link'] = null;
        }

        return $data;
    }

    /**
     * ketika statusnya diubah maka cek apakah bisa mengedit deadline
     *
     * @return void
     */
    public function updatedStatus()
    {
        // kalau diubah ke butuh revisi maka diperbolehkan untuk edit deadline
        if ($this->status == PENEBUSAN_BUTUH_REVISI) $this->canEditDeadline = true;
        else $this->canEditDeadline = true;
    }

    /**
     * update penebusan
     *
     * @return void
     */
    public function update()
    {
        $this->validate([
            'status' => 'required',
            'deadline' => 'required',
            'file' => 'max:2048'
        ]);

        if (!userHasPermission(PERMISSION_UPDATE_PENEBUSAN)) {
            $this->dispatch('updated', title: 'Kamu tidak memiliki akses untuk edit penebusan', icon: 'error', iconColor: 'red');
        } else {
            // jika bisa edit deadline
            if ($this->canEditDeadline) {
                // Cek apakah sekarang lebih dari deadline dan status bukan Sedang Dikoreksi
                if (now()->gt($this->deadline) && $this->selected->status != PENEBUSAN_SEDANG_DIKOREKSI)
                    $this->status = PENEBUSAN_TERLAMBAT;
                else if ($this->selected->status == PENEBUSAN_TERLAMBAT)
                    $this->status = PENEBUSAN_MENUNGGU_UPLOAD;
            }

            $data = $this->logicStatus($this->status);
            $data['deadline'] = $this->deadline ?? null;
            $data['status'] = $this->status;
            $data['catatan'] = $this->catatan ?? null;

            try {
                $this->selected->update($data);
                $this->resetAll();
                $this->dispatch('updated', title: 'Berhasil mengubah status penebusan', icon: 'success', iconColor: 'green');
            } catch (\Throwable $th) {
                \Log::error('Error updating penebusan: ' . $th->getMessage());
                $this->dispatch('updated', title: "Gagal mengubah status penebusan", icon: 'error', iconColor: 'red');
            }
        }
        $this->resetAll();
    }

    /**
     * untuk memunculkan detail penebusan
     *
     * @param  mixed $penebusan
     * @return void
     */
    public function show(Penebusan $penebusan)
    {
        $this->penebusanToShow = $penebusan->load(['user', 'jenispoin']);
        $this->showModalDetail = true;
    }

    /**
     * destroy penebusan
     *
     * @param  mixed $penebusan
     * @return void
     */
    public function destroy(Penebusan $penebusan)
    {
        if (!userHasPermission(PERMISSION_DELETE_PENEBUSAN)) {
            $this->dispatch('updated', title: 'Kamu tidak memiliki akses untuk menghapus penebusan', icon: 'error', iconColor: 'red');
        } else {
            try {
                if ($penebusan->link) Storage::delete($penebusan->link);
                $poin_id = $penebusan->poin_id ?? null;

                $penebusan->delete();
                if ($poin_id) Poin::destroy($poin_id);

                $this->dispatch('updated', title: 'Berhasil menghapus penebusan', icon: 'success', iconColor: 'green');
            } catch (\Throwable $th) {
                $this->dispatch('updated', title: 'Gagal menghapus penebusan', icon: 'error', iconColor: 'red');
            }
        }
        $this->resetAll();
    }

    #[On('reloadTablePenebusanAdmin')]
    public function refresh()
    {
        // Magic method $refresh() sekarang menjadi method explicit
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedStatus()
    {
        $this->resetPage();
    }

    public function updatingSelectedTipe()
    {
        $this->resetPage();
    }

    /**
     * getPenebusan sesuai dengan filter
     *
     * @param  mixed $search
     * @return void
     */
    private function getPenebusan($search)
    {
        // refresh status semua data penebusan, untuk ngeliat apakah ada yang sudah terlambat atau belum
        Penebusan::refreshStatus();

        $penebusan = Penebusan::with(['user', 'jenispoin']);
        if ($this->selectedStatus != -1)
            $penebusan->where('status', $this->selectedStatus);

        if ($this->selectedTipe != -1)
            $penebusan->whereHas('jenispoin', function ($query) {
                $query->where('type', $this->selectedTipe);
            });

        return $penebusan->whereHas('user', function ($query) use ($search) {
            $query->where('name', 'like', $search)
                ->orWhere('nimb', 'like', $search);
        })->latest()->paginate(NUMBER_OF_PAGINATION);
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('admin.tibum.penebusan.table', ['penebusan' => $this->getPenebusan($search)]);
    }
}
