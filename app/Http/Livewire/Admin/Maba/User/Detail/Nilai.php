<?php

namespace App\Http\Livewire\Admin\Maba\User\Detail;

use Livewire\Component;

class Nilai extends Component
{
    public $indikator, $ip, $canInputNilai, $user;

    protected $listeners = ['refreshTabelNilai' => '$refresh'];

    public function mount($user)
    {
        // ambil nilainya
        $this->user = $user;
        $this->indikator = $user->getNilai();
        $this->ip = $user->getIp();
        $this->canInputNilai = canInputNilai($user);
    }

    public function render()
    {
        return view('admin.maba.user.detail.nilai');
    }
}
