<?php

namespace App\Http\Livewire\Home\Dashboard;

use App\Models\Publishable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Materi extends Component
{
    public $showModalMateri = false;
    public $contents;


    public function render()
    {
        $this->contents = Publishable::where('category', CATEGORY_PUBLISHABLE_MATERI)
            ->where('publish_datetime', '<=', DB::raw(rawSQLDateTime()))
            ->orderby('publish_datetime', 'desc')
            ->get();

        return view('home.dashboard.materi', [
            'count' => $this->contents->count()
        ]);
    }
}
