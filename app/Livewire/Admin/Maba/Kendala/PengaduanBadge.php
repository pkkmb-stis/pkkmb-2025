<?php

namespace App\Livewire\Admin\Maba\Kendala;

use App\Models\Kendala;
use Livewire\Component;
use Livewire\Attributes\On;

class PengaduanBadge extends Component
{
    public $pengaduanCount;

    public function mount()
    {
        $this->pengaduanCount = Kendala::where('status', 0)->count();
    }

    #[On('pengaduanUpdated')]
    public function updatePengaduanCount($count = null)
    {
        $this->pengaduanCount = $count;
    }

    public function render()
    {
        return view('components.pengaduan-badge');
    }
}
