<?php

namespace App\Livewire\Home\Dashboard\Penebusan;

use Livewire\Component;
use App\Models\Poin\JenisPoin;
use App\Models\Poin\Penebusan;
use App\Models\Poin\Poin;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class Add extends Component
{
    use WithFileUploads;
    public $user, $poin, $poin_id, $deadline, $jenispoin;
    public $detailTugas;
    public $detailPoin;
    public $canAdd;

    protected $rules = [
        'deadline' => 'nullable',
        'status' => 'required|exists:penebusan_user,status',
        'jenispoin' => 'required|exists:jenis_poin,id',
        'users' => 'required|array',
        'file' => 'nullable|max:5120'
    ];

    /**
     * fungsi yang pertama kali dijalanin
     *
     * @param  mixed $detailPoin
     * @return void
     */
    public function mount($detailPoin)
    {
        $this->user = auth()->user();
        if (!$this->detailPoin) $this->detailPoin = auth()->user()->getKalkulasiPoin();
    }

    #[On('toastShow')]
    public function updateCanAdd()
    {
        if ($this->detailPoin['akumulasi'] + Poin::getUnfinishedPenebusanPoin($this->user->id) >= POIN_MINIMUM) {
            $this->canAdd = false;
        } else $this->canAdd = true;
    }

    /**
     * resetAll inputan
     *
     * @return void
     */
    public function resetAll()
    {
        $this->reset('deadline', 'jenispoin', 'poin');
        $this->resetValidation();
    }

    /**
     * ketika maba telah memilih jenis poin maka generate deadline dan detailnya
     *
     * @return void
     */
    public function updatedJenispoin()
    {
        $jenispoin = JenisPoin::find($this->jenispoin);
        $this->deadline = Carbon::now()->addDay()->setTime(23, 59);
        $this->detailTugas = $jenispoin->detail;
        $this->poin = $jenispoin->poin;
    }

    /**
     * submit
     *
     * @return void
     */
    public function submit()
    {
        //* Validasi
        if (!$this->canAdd) {
            $this->dispatch('updated', 
                title: 'Kamu tidak bisa menambahkan penebusan', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }
        $this->validate(['jenispoin' => 'required']);
        // cek apakah jenis penebusan ini bisa diambil oleh maba
        $jenispoinObj = JenisPoin::getAvailablePenebusan($this->user->id)->find($this->jenispoin);

        if (!$jenispoinObj)
            $this->dispatch('updated', 
                title: 'Kamu tidak bisa memilih penebusan ini', 
                icon: 'error', 
                iconColor: 'red'
            );
        else {
            try {
                Penebusan::create([
                    'user_id' => $this->user->id,
                    'jenis_poin_id' => intval($this->jenispoin),
                    'deadline' => $this->deadline ?? null,
                    'status' => PENEBUSAN_MENUNGGU_UPLOAD,
                    'link' => null,
                    'accepted_at' => null,
                    'submited_at' => null,
                    'taken_at' => now(),
                ]);
                $this->dispatch('updated', 
                    title: 'Penebusan berhasil ditambahkan', 
                    icon: 'success', 
                    iconColor: 'green'
                );
                $this->dispatch('reloadListPenebusanDashboard');
            } catch (\Throwable $th) {
                $this->dispatch('updated', 
                    title: 'Penebusan gagal dibuat', 
                    icon: 'error', 
                    iconColor: 'red'
                );
            }
        }
        $this->resetAll();
    }

    public function render()
    {
        $this->updateCanAdd();
        return view(
            'home.dashboard.penebusan.add',
            ['jenispoins' => JenisPoin::getAvailablePenebusan($this->user->id)]
        );
    }
}
