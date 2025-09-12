<?php

namespace App\Livewire\Admin\Maba\Poin\Kelompok;

use App\Models\User;
use Livewire\Component;
use App\Models\Kelompok;
use App\Models\Poin\Poin;
use App\Models\Poin\JenisPoin;
use App\Models\Poin\PoinKelompok;
use Illuminate\Support\Facades\DB;

class Add extends Component
{
    public $kelompoks, $jenis_poin_kelompok, $kelompok, $jenis_poin;
    public $poin = 2;
    public $addmodal = false;

    public function mount()
    {
        $this->kelompoks = Kelompok::orderBy('nama', 'asc')->get();
        $this->jenis_poin_kelompok = JenisPoin::where('nama', 'like', '%Menjadi Kelompok%')->get();
    }

public function submit()
{
    if (!userHasPermission(PERMISSION_SHOW_POIN_KELOMPOK)) {
        return $this->dispatch('updated', 
            title: 'Kamu tidak memiliki akses untuk menentukan jenis poin kelompok', 
            icon: 'error', 
            iconColor: 'red'
        );
    }

    $this->validate([
        'kelompok' => 'required|numeric',
        'jenis_poin' => 'required'
    ]);

    try {
        DB::beginTransaction();
        
        $poin_kelompok = PoinKelompok::where('jenis_poin_id', $this->jenis_poin)
            ->where('hari', 'like', date('Y-m-d', time()) . '%')
            ->first();

        if (empty($poin_kelompok->id)) {
            $data_poin_kelompoks = [
                'kelompok_id' => $this->kelompok,
                'jenis_poin_id' => $this->jenis_poin,
                'poin' => $this->poin,
                'hari' => now()
            ];

            PoinKelompok::create($data_poin_kelompoks);

            $users = User::where('kelompok_id', $this->kelompok)->get();
            foreach ($users as $user) {
                $data = [
                    'user_id' => $user->id,
                    'jenis_poin_id' => $this->jenis_poin,
                    'urutan_input' => now(),
                    'poin' => $this->poin
                ];
                Poin::create($data);
            }

            DB::commit();

            $this->dispatch('updated', 
                title: 'Jenis poin kelompok berhasil diberikan. Tiap-tiap anggota sudah mendapatkan ' . $this->poin . ' poin.', 
                icon: 'success', 
                iconColor: 'green'
            );

            $this->dispatch('reloadTablePoinKelompok');
            
            // Reset only on success
            $this->resetAll(false);
            $this->dispatch('resetSlim');
            
        } else {
            $this->dispatch('updated', 
                title: "Gagal menetapkan jenis poin kelompok. Data sudah ada.", 
                icon: 'error', 
                iconColor: 'red'
            );
        }
        
    } catch (\Throwable $th) {
        DB::rollBack();
        
        // Log error untuk debugging, jangan gunakan dd()
        \Log::error('Gagal menetapkan jenis poin kelompok: ' . $th->getMessage());
        
        $this->dispatch('updated', 
            title: "Gagal menetapkan jenis poin kelompok", 
            icon: 'error', 
            iconColor: 'red'
        );
    }
}


    public function resetAll($closeModal = true)
    {
        $this->reset('kelompok', 'jenis_poin');
        $this->resetValidation();
        if ($closeModal)
            $this->reset('addmodal');
    }

    public function closeModal()
    {
        $this->addmodal = false;
        $this->reset('kelompok', 'jenis_poin');
        $this->resetValidation();
    }

    public function render()
    {
        return view('admin.maba.poin.kelompok.add');
    }
}