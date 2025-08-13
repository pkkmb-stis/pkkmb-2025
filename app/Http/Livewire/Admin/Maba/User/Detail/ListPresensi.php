<?php

namespace App\Http\Livewire\Admin\Maba\User\Detail;

use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ListPresensi extends Component
{
    public $user;
    public $showDetailAbsensi = false;
    public $detailAbsensi;
    public $title;

    public function getAbsensiData($user)
    {
        $belumAbsen = Event::presensi()->whereDoesntHave('user', function (Builder $query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();


        $sudahAbsen = $this->user->event()->orderBy('waktu_mulai', 'desc')->get();
        return $belumAbsen->merge($sudahAbsen)->sortby('waktu_mulai');
    }

    public function openDetailAbsensi($absensi = null, $title = "")
    {
        if ($absensi) {
            $this->title = $title;
            $this->detailAbsensi = $absensi;
            $this->showDetailAbsensi = true;
        }
    }

    public function render()
    {

        return view('admin.maba.user.detail.list-presensi', [
            'detailAbsensi' => $this->detailAbsensi,
            'absensi' => $this->getAbsensiData($this->user)
        ]);
    }
}
