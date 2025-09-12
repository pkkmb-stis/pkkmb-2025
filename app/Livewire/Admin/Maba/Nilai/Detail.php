<?php

namespace App\Livewire\Admin\Maba\Nilai;

use App\Models\User;
use Exception;
use Livewire\Component;

class Detail extends Component
{
    public $user;
    public $indikator;

    protected $rules = [
        'indikator.*.nilai' => 'numeric|min:0|max:100',
    ];

    /**
     * ambil data user yang akan diubah
     *
     * @param  mixed $user
     * @return void
     */
    public function mount(User $user)
    {
        $this->user = $user->load('kelompok');
        $this->indikator = $user->getNilai();
    }

    /**
     * simpanNilai
     *
     * @return void
     */
    public function simpanNilai()
    {
        try {
            $idPenilai = auth()->user()->id;
            
            foreach ($this->indikator as $nilai) {
                if ($nilai->nilai) {
                    $nilai->user()->syncWithoutDetaching([$this->user->id => [
                        'penilai_id' => $idPenilai,
                        'nilai' => $nilai->nilai
                    ]]);
                }
            }
            
            $this->dispatch('updated', 
                title: 'Berhasil menyimpan nilai', 
                icon: 'success', 
                iconColor: 'green'
            );
            
        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan nilai: ' . $e->getMessage());
            
            $this->dispatch('updated', 
                title: 'Gagal menyimpan nilai', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }



    public function render()
    {
        return view('admin.maba.nilai.detail', [
            'ip' => $this->user->getIp(),
        ]);
    }
}
