<?php

namespace App\Http\Livewire\Admin\Maba\Kendala;

use App\Models\Kendala;
use Livewire\Component;

class PengaduanBadge extends Component
{
    public $pengaduanCount;

    protected $listeners = [
        'pengaduanUpdated' => 'updatePengaduanCount'
    ];

    public function mount()
    {
        $this->pengaduanCount = Kendala::where('status', 0)->count();
    }

    public function updatePengaduanCount($count = null)
    {
        $this->pengaduanCount = $count;
    }


    public function render()
    {
        return view('components.pengaduan-badge');
    }
}
