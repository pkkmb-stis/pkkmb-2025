<?php

namespace App\Livewire\Admin\Maba\User\Detail;

use App\Models\Poin\Poin as PoinModel;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Poin extends Component
{
    use WithPagination;

    private $listPoin;
    public $user;
    public $detailPoins;
    public $poin;
    public $banyakBonus, $banyakPelanggaran, $banyakPenebusan;
    public $showModalDetail = false;
    public $poinToShow;
    public $cadangan;

    public $tablejenispoin = 'jenis_poin';

    /**
     * ambil data yang diperlukan
     *
     * @param  mixed $idUser
     * @return void
     */
    public function mount($idUser)
    {
        $this->user = User::find($idUser);
        $this->detailPoins = $this->user->getKalkulasiPoin();

        $this->banyakBonus = $this->detailPoins['bonus'];
        $this->banyakPelanggaran = $this->detailPoins['pelanggaran'];
        $this->banyakPenebusan = $this->detailPoins['penebusan'];
        $this->akumulasi = $this->detailPoins['akumulasi'];
        $this->cadangan = $this->detailPoins['cadangan'];

        if (count($this->detailPoins) != 0) $this->poin = $this->detailPoins['akumulasi'];
        else $this->poin = POIN_AWAL_MABA;

        $this->listPoin = $this->detailPoins['list'];
        // ini untuk detailnya soalnya hanya bisa menyimpan data dalam bentuk string
        $this->detailPoins = $this->detailPoins['list']->toJson();
    }

    /**
     * show modal detail
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        // cari data yang akan ditampilkan pada data json yang kita simpan
        $this->poinToShow = collect(json_decode($this->detailPoins, true))
            ->where('id', $id)
            ->first();
        $this->showModalDetail = true;
    }

    public function getWindowWidth($id, $width)
    {
        // Handle the logic based on window width
        if ($width <= 640) {
            $this->show($id);
        }
    }

    public function render()
    {
        return view('admin.maba.user.detail.poin', [
            'poins' => $this->user->getPoins(),
            'listPoin' => PoinModel::getJSONPoin($this->user->id, $this->listPoin)
        ]);
    }
}
