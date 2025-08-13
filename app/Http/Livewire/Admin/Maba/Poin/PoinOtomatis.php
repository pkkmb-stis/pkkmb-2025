<?php

namespace App\Http\Livewire\Admin\Maba\Poin;

use App\Models\Poin\JenisPoin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class PoinOtomatis extends Component
{
    public $password;
    public $waktuAwal;
    public $waktuAkhir;
    public $isPatuhAtribut = false;
    public $isPatuhKuliahUmum = false;
    public $isPatuhHariIni = false;
    public $isPatuhTugas = false;
    public $isPatuhAtributPKBN = false;
    public $modalPoinOtomatis = false;

    private function getMabaPatuh($idJenisPoin)
    {
        if ($idJenisPoin == null) {
            return User::has('kelompok')->whereDoesntHave('poins', function (Builder $query) {
                $query->whereBetween('urutan_input', [$this->waktuAwal, $this->waktuAkhir])
                    ->whereHas('jenispoin', function (Builder $query) {
                        $query->where('category', CATEGORY_JENISPOIN_PELANGGARAN);
                    });
            })->get()->pluck('id');
        } else {
            return User::has('kelompok')->whereDoesntHave('poins', function (Builder $query) use ($idJenisPoin) {
                $query->whereBetween('urutan_input', [$this->waktuAwal, $this->waktuAkhir])
                    ->whereIn('jenis_poin_id', $idJenisPoin);
            })->get()->pluck('id');
        }
    }

    private function insertPoinPatuh($listMaba, $idPoin)
    {
        try {
            $jenisPoin = JenisPoin::find($idPoin);
            $jenisPoin->users()->attach($listMaba, [
                'urutan_input' => now(),
                'poin' => $jenisPoin->poin
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function generatePoin() {
        $count = 0;
        $patuhAtribut = Collection::make($items = []);
        $patuhKuliahUmum = Collection::make($items = []);
        $patuhHariIni = Collection::make($items = []);
        $patuhTugas = Collection::make($items = []);
        $patuhAtributPKBN = Collection::make($items = []);

        if ($this->isPatuhAtribut) {
	        $patuhAtribut =  $this->getMabaPatuh([
                JENISPOIN_ATRIBUT_TIDAK_LENGKAP,
                JENISPOIN_PAKAIAN_KUCEL,
                JENISPOIN_NODA_TAMPAK,
                JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN,
                JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN_CINCIN,
                JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN_GELANG,
                JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN_KALUNG
            ]);
            $count += count($patuhAtribut);
        }

        if ($this->isPatuhKuliahUmum) {
            $patuhKuliahUmum = $this->getMabaPatuh([
                JENISPOIN_KU_TIDUR,
                JENISPOIN_KU_NGOBROL,
                JENISPOIN_KU_DUDUK_TIDAK_SESUAI,
                JENISPOIN_KU_MAKAN,
                JENISPOIN_KU_MAIN_HP,
                JENISPOIN_TIDAK_TERTIB_KU,
                JENISPOIN_KU_TRANSISI_TIDAK_TERTIB
            ]);
            $count += count($patuhKuliahUmum);
        }

        if ($this->isPatuhHariIni) {
            $patuhHariIni = $this->getMabaPatuh(null);
            $count += count($patuhHariIni);
        }

        if ($this->isPatuhTugas) {
            $patuhTugas =  $this->getMabaPatuh([
                JENISPOIN_TUGAS_TIDAK_LENGKAP,
                JENISPOIN_TUGAS_TERLAMBAT
            ]);
            $count += count($patuhTugas);
        }

        if ($this->isPatuhAtributPKBN) {
            $patuhAtributPKBN = $this->getMabaPatuh([
                JENISPOIN_ATRIBUT_TIDAK_LENGKAP
            ]);
            $count += count($patuhAtributPKBN);
        }

        try {
            DB::beginTransaction();

	        $this->insertPoinPatuh($patuhAtribut, JENISPOIN_ATRIBUT_LENGKAP);
	        $this->insertPoinPatuh($patuhKuliahUmum, JENISPOIN_TERTIB_KU);
	        $this->insertPoinPatuh($patuhHariIni, JENISPOIN_TIDAK_MELAKUKAN_KESALAHAN);
	        $this->insertPoinPatuh($patuhTugas, JENISPOIN_PATUH_TUGAS);
	        $this->insertPoinPatuh($patuhAtributPKBN, JENISPOIN_ATRIBUT_PKBN_LENGKAP);

            DB::commit();

            $this->emit('reloadTableInputPoin');
            $this->reset(
                'password',
                'waktuAwal',
                'waktuAkhir',
                'isPatuhAtribut',
                'isPatuhKuliahUmum',
                'isPatuhHariIni',
                'isPatuhTugas',
                'isPatuhAtributPKBN',
                'modalPoinOtomatis',
            );
            $this->dispatchBrowserEvent(
                'updated', 
                [
                    'title' => "Berhasil generate {$count} poin penghargaan. Silakan refresh jika halaman tidak merespon",
                    'icon' => 'success',
                    'iconColor' => 'green'
                ]
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->emit('reloadTableInputPoin');
            $this->reset('modalPoinOtomatis', 'waktuAwal', 'waktuAkhir', 'password');
            $this->dispatchBrowserEvent(
                'updated', [
                    'title' => "Gagal generate poin. Silakan refresh halaman dan coba lagi",
                    'icon' => 'error',
                    'iconColor' => 'red'
                ]
            );
        }
        $this->resetValidation();
    }

    public function submit()
    {
        $this->validate([
            'password' => 'required',
            'waktuAwal' => 'required',
            'waktuAkhir' => 'required'
        ]);
        if (Hash::check(md5($this->password), auth()->user()->password))
            $this->generatePoin();
        else
            $this->addError('password', 'Password tidak cocok');
    }
    public function render()
    {
        return view('admin.maba.poin.poin-otomatis');
    }

    public function setWaktu() {
        $this->waktuAwal = date('Y-m-d 00:00:00');
        $this->waktuAkhir = date('Y-m-d 23:59:59');
    }
}
