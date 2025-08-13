<?php

namespace App\Http\Livewire\Home;

use App\Models\Publishable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pengumuman extends Component
{
    public $showModalPengumuman = false;
    public $contents;

    public function render()
    {
        $this->contents = Publishable::where('category', CATEGORY_PUBLISHABLE_PENGUMUMAN)
            ->where('publish_datetime', '<=', DB::raw(rawSQLDateTime()))
            ->orderby('publish_datetime', 'desc')
            ->get();

        return view('home.pengumuman', [
            'count' => $this->contents->count(),
        ]);
    }
}
