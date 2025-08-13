<?php

namespace App\Http\Livewire\Admin\Maba\User\Detail;

use App\Models\Kendala;
use Livewire\Component;
use Livewire\WithPagination;

class ListKendala extends Component
{
    use WithPagination;
    public $user;
    public $showDetailKendala = false;
    public $detailKendala;

    public function openDetailKendala($id = null)
    {
        if ($id) {
            $this->detailKendala = Kendala::find($id);
            $this->showDetailKendala = true;
        }
    }

    public function render()
    {
        return view('admin.maba.user.detail.list-kendala', [
            'kendala' =>  $this->user->kendala()->orderBy('created_at', 'desc')->paginate(5),
        ]);
    }
}
