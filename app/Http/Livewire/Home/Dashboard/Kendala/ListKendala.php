<?php

namespace App\Http\Livewire\Home\Dashboard\Kendala;

use App\Models\Kendala;
use Livewire\Component;
use Livewire\WithPagination;

class ListKendala extends Component
{
    use WithPagination;
    public $showDetailKendala = false;
    public $detailKendala;

    protected $listeners = ['refreshListKendala' => '$refresh'];

    /**
     * openDetailKendala
     *
     * @param  mixed $id
     * @return void
     */
    public function openDetailKendala($id = null)
    {
        if ($id) {
            $this->detailKendala = Kendala::find($id);
            $this->showDetailKendala = true;
        }
    }

    public function render()
    {
        return view('home.dashboard.kendala.list-kendala', [
            'kendala' =>  auth()->user()->kendala()->orderBy('created_at', 'desc')->paginate(2),
        ]);
    }
}
