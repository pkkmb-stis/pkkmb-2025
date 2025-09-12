<?php

namespace App\Livewire\Home\Dashboard\Penebusan;

use App\Models\Poin\Penebusan;
use App\Models\Poin\Poin;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class Upload extends Component
{
    use WithFileUploads;

    public $openedit = false;
    public $file;
    public $selected;

    /**
     * listeners untuk menampilkan modal ketika ingin mengupload file penugasan
     *
     * @param  mixed $penebusan
     * @return void
     */
    #[On('mabaUploadPenebusan')]
    public function mabaUploadPenebusan(Penebusan $penebusan)
    {
        $this->selected = $penebusan->load(['jenispoin', 'poin']);
        if ($this->selected->user_id != auth()->user()->id) {
            $this->dispatch('updated', 
                title: 'Tidak dapat upload penebusan', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }
        $this->openedit = true;
    }

    /**
     * deletePoin
     *
     * @return void
     */
    private function deletePoin()
    {
        if ($this->selected && $this->selected->poin_id) {
            $poin_id = $this->selected->poin_id;
            $this->selected->update(['poin_id' => null]);
            Poin::where('id', $poin_id)->delete();
        }
    }

    /**
     * updatedFile ketika diupload
     *
     * @return void
     */
    public function updatedFile()
    {
        $this->validate(['file' => 'max:2048']);
    }

    public function update()
    {
        $this->validate(['file' => 'required|max:2048']);

        if ($this->selected->link)
            Storage::delete($this->selected->link);

        // Cek apakah waktu dia ngumpulin tugas sudah terlambat atau belum, jika lambat maka batalkan submitnya
        if (now()->gt($this->selected->deadline)) {
            $this->selected->update([
                'status' => PENEBUSAN_TERLAMBAT,
                'link' => null,
            ]);
            $this->dispatch('updated', 
                title: 'Kamu sudah terlambat. Hubungi Tibum', 
                icon: 'error', 
                iconColor: 'red'
            );
        } else {
            // siapkan nama file
            $user = auth()->user();
            $namaFile = $user->name . '_' . $user->username . '_' . now()->format('YmdHis') . '.';

            try {
                $linkFile = $this->file->storeAs('penebusan', $namaFile . $this->file->extension());
                $this->selected->update([
                    'status' => PENEBUSAN_SEDANG_DIKOREKSI,
                    'link' => $linkFile,
                    'submited_at' => now(),
                ]);

                $this->resetAll();
                $this->dispatch('updated', 
                    title: 'Berhasil mengupload tugas penebusan', 
                    icon: 'success', 
                    iconColor: 'green'
                );
            } catch (\Throwable $th) {
                $this->dispatch('updated', 
                    title: 'Gagal mengupload tugas penebusan', 
                    icon: 'error', 
                    iconColor: 'red'
                );
            }
        }

        $this->resetAll();
        $this->dispatch('reloadListPenebusanDashboard');
    }

    /**
     * resetAll inputan
     *
     * @return void
     */
    public function resetAll()
    {
        $this->reset('selected', 'openedit', 'file');
    }

    public function render()
    {
        return view('home.dashboard.penebusan.upload');
    }
}
