<?php

namespace App\Http\Livewire\Admin\Maba\User\Detail;

use App\Models\Poin\JenisPoin;
use App\Models\Poin\Penebusan;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ListPenebusan extends Component
{
    public $user;
    public $detailPoins;

    public $penebusanToShow;
    public $showModalDetail = false;

    protected $listeners = [
        'reloadListPenebusanDashboard' => '$refresh',
    ];

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
            if ($penebusan->link) Storage::delete($penebusan->link);

            // cek apakah sudah ada poinnya, jika ada maka hapus
            $poin_id = $penebusan->poin_id ?? null;
            $penebusan->delete();
            if ($poin_id) Poin::find($poin_id)->delete();

            $this->dispatchBrowserEvent('updated', ['title' => 'Data penebusan berhasil dihapus', 'icon' => 'success', 'iconColor' => 'green']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('updated', ['title' => 'Data penebusan gagal dihapus', 'icon' => 'error', 'iconColor' => 'red']);
        }
        $this->reset('penebusanToShow', 'showModalDetail');
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
            'jenispoins' => JenisPoin::getAvailablePenebusan($this->user->id), // ambul jenispoin penebusan yang bisa dipilih oleh maba
        ]);
    }
}
