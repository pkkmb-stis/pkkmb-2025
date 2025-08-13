<?php

namespace App\Http\Livewire\Admin\Maba\Nilai;

use App\Models\Kelompok;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    private $users;
    public $daftar_kelompok;

    public $search;
    public $kelompok = -1;
    public $canUpdateAll = false;
    public $kelompokCanEdit = [];


    /**
     * yang pertama dijalanin, ambil semua nama kelompok
     *
     * @return void
     */
    public function mount()
    {
        $this->daftar_kelompok = Kelompok::all();
        //  cek kalau dia punya permission update nilai maka
        if (auth()->user()->can(PERMISSION_UPDATE_NILAI))
            $this->canUpdateAll = true;
        else if (auth()->user()->isLapk())
            $this->kelompokCanEdit = auth()->user()->handleKelompok->pluck('id')->toArray();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingKelompok()
    {
        $this->resetPage();
    }

    /**
     * getUsers berdasarkan filter kelompok dan nama
     *
     * @param  mixed $search
     * @return void
     */
    private function getUsers($search)
    {
        $query = User::with('kelompok')->whereHas('kelompok')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', $search)
                    ->orWhere('nimb', 'like', $search);
            });

        if ($this->kelompok != -1)
            $query = $query->where('kelompok_id', $this->kelompok);

        return $query->orderBy('name')
            ->paginate(NUMBER_OF_PAGINATION);
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('admin.maba.nilai.show', ['users' => $this->getUsers($search)]);
    }
}
