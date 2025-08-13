<?php

namespace App\Http\Livewire\Home\Profil;

use Livewire\Component;
use App\Models\Formulir;
use Livewire\WithPagination;
use App\Models\FormulirVerification;
use App\Models\Poin\Poin as PoinModel;

class Poin extends Component
{
    use WithPagination;

    private $listPoin;
    public $detailPoins;
    public $akumulasi;
    public $cadangan;
    public $banyakBonus, $banyakPelanggaran, $banyakPenebusan;
    public $showModalDetail = false;
    public $poinToShow;

    /**
     * mount, ambil data yang diperlukan
     *
     * @return void
     */
    public function mount()
    {
        $this->detailPoins = auth()->user()->getKalkulasiPoin();
        $this->banyakBonus = $this->detailPoins['bonus'];
        $this->banyakPelanggaran = $this->detailPoins['pelanggaran'];
        $this->banyakPenebusan = $this->detailPoins['penebusan'];
        $this->akumulasi = $this->detailPoins['akumulasi'];
        $this->cadangan = $this->detailPoins['cadangan'];

        if (count($this->detailPoins) != 0) $this->poin = $this->detailPoins['akumulasi'];
        else $this->poin = POIN_AWAL_MABA;

        $this->listPoin = $this->detailPoins['list'];
        // data detailnya simpan di json karena format tersebut yang bisa disimpan ketika variabelnya public
        $this->detailPoins = $this->detailPoins['list']->toJson();
    }

    /**
     * show detail absensi
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        // ambil dari data yang di json tadi
        $this->poinToShow = collect(json_decode($this->detailPoins, true))->where('id', $id)->first();
        $this->showModalDetail = true;
    }

    public function render()
    {
        $user = auth()->user();
        $unfilledFormulirs = [];
        $check = true;

        if ($user->is_maba) {
            $visibleFormulirs = Formulir::where('is_visible', true)->get();

            foreach ($visibleFormulirs as $formulir) {
                $userNimb = $user->nimb;

                // Mengecek apakah user telah mengisi formulir tertentu
                $userFormulirExists = FormulirVerification::where('nimb', $userNimb)
                    ->where('formulir_id', $formulir->id)
                    ->exists();

                if (!$userFormulirExists) {
                    $unfilledFormulirs[] = $formulir;
                }
            }

            if (!empty($unfilledFormulirs)) {
                $check = false;
            }
        }

        return view('home.profil.poin', [
            'poins' =>  auth()->user()->getPoins(),
            'listPoin' => PoinModel::getJSONPoin(auth()->user()->id, $this->listPoin),
            'check' => $check,
            'unfilledFormulirs' => $unfilledFormulirs
        ]);
    }
}
