<?php

namespace App\Livewire\Admin\Maba\User\Detail;

use App\Models\Poin\JenisPoin;
use App\Models\Poin\Penebusan;
use App\Models\Poin\Poin;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\On;

class ListPenebusan extends Component
{
    public $user;
    public $detailPoins;

    public $penebusanToShow;
    public $showModalDetail = false;

    /**
     * mount, yang pertama dijalanin
     *
     * @return void
     */
    public function mount(User $user)
    {
        // update status penebusan, cek apakah sudah ada yang terlambat atau belum
        $this->user = $user;
        Penebusan::refreshStatus();
        $this->detailPoins = $this->user->getKalkulasiPoin();
    }

    /**
     * show detail penebusan
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $this->penebusanToShow = Penebusan::with(['user', 'jenispoin'])->find($id);
        $this->showModalDetail = true;
    }

    /**
     * destroy penebusan
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        try {
            $penebusan = Penebusan::find($id);
            
            if (!$penebusan) {
                $this->dispatch('updated', 
                    title: 'Data penebusan tidak ditemukan', 
                    icon: 'error', 
                    iconColor: 'red'
                );
                return;
            }

            // Delete file if exists
            if ($penebusan->link) {
                Storage::delete($penebusan->link);
            }

            // Store poin_id before deleting penebusan
            $poin_id = $penebusan->poin_id;
            
            // Delete penebusan record
            $penebusan->delete();

            // Delete related poin if exists
            if ($poin_id) {
                $poin = Poin::find($poin_id);
                if ($poin) {
                    $poin->delete();
                }
            }

            $this->dispatch('updated', 
                title: 'Data penebusan berhasil dihapus', 
                icon: 'success', 
                iconColor: 'green'
            );
            
        } catch (\Throwable $th) {
            \Log::error('Error deleting penebusan: ' . $th->getMessage());
            
            $this->dispatch('updated', 
                title: 'Data penebusan gagal dihapus', 
                icon: 'error', 
                iconColor: 'red'
            );
        }

        $this->reset('penebusanToShow', 'showModalDetail');
    }

    #[On('reloadListPenebusanDashboard')]
    public function refresh()
    {
        // Magic method $refresh() sekarang menjadi method explicit
    }

    public function render()
    {
        $penebusans = Penebusan::with(['user', 'jenispoin'])
            ->where('user_id', $this->user->id)
            ->latest()
            ->get();

        // kalau tidak ada penebusan dan poinnya diatas minimal maka jangan tampilkan apa apa
        if ($penebusans->count() == 0 && $this->detailPoins['akumulasi'] >= POIN_MINIMUM) {
            return '<span></span>';
        }

        return view('admin.maba.user.detail.list-penebusan', [
            'penebusan' => $penebusans,
            'jenispoins' => JenisPoin::getAvailablePenebusan($this->user->id), // ambil jenispoin penebusan yang bisa dipilih oleh maba
        ]);
    }
}
