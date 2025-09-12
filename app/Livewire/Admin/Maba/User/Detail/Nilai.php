<?php

namespace App\Livewire\Admin\Maba\User\Detail;

use Livewire\Component;
use Livewire\Attributes\On;

class Nilai extends Component
{
    public $indikator, $ip, $canInputNilai, $user;

    public function mount($user)
    {
        // ambil nilainya
        $this->user = $user;
        $this->indikator = $user->getNilai();
        $this->ip = $user->getIp();
        $this->canInputNilai = canInputNilai($user);
    }

    #[On('refreshTabelNilai')]
    public function refresh()
    {
        // Magic method $refresh() sekarang menjadi method explicit
        // Re-calculate nilai when refreshed
        $this->indikator = $this->user->getNilai();
        $this->ip = $this->user->getIp();
        $this->canInputNilai = canInputNilai($this->user);
    }

    public function render()
    {
        return view('admin.maba.user.detail.nilai');
    }
}
