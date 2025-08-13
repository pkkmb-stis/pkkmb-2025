<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Event;
use App\Models\Poin\Poin;
use Illuminate\Http\Request;
use App\Models\Poin\JenisPoin;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;

class MabaController extends Controller
{
    public function user()
    {
        return view('admin.maba.user.index');
    }

    private function savePreviosUrl()
    {
        $previousUrl = URL::previous();

        $urlSegment = collect(explode('/', $previousUrl))->reverse();
        if ($urlSegment->search('admin')) $menu = 'Admin';
        else if ($urlSegment->search('kelompok')) $menu = "Atur Kelompok";
        else if ($urlSegment->search('penebusan')) $menu = "Penebusan";
        else if ($urlSegment->search('kendala')) $menu = "Kendala";
        else $menu = 'User';

        if ($urlSegment->search('poin'))
            $previousUrl = Url::route('user.show');

        session()->put('previous-url', $previousUrl);
        return $menu;
    }

    public function userDetail($id)
    {
        $user = User::with(['kelompok', 'kabupaten'])->findOrFail($id);

        $data = [
            'user' => $user,
            'menu' => $this->savePreviosUrl(),
            'poins' => $user->getKalkulasiPoin(),
            'halaman' => 'detail'
        ];

        return view('admin.maba.user.detail.index', $data);
    }

    public function userDetailPoin($id)
    {
        $user = User::findOrFail($id);
        if ($user->is_maba || $user->hasRole(ROLE_PANITIA))
            return view('admin.maba.user.detail.index', [
                'menu' => $this->savePreviosUrl(),
                'halaman' => 'poin',
                'idUser' => $user->id
            ]);
        return redirect()->back();
    }


    public function event()
    {
        return view('admin.maba.event.index');
    }

    public function eventDetail($id)
    {
        $event = Event::findOrFail($id);

        // cek apakah event merupakan tipe presensi
        if ($event->category != CATEGORY_EVENT_PRESENSI)
            return redirect()->back();

        return view('admin.maba.event.detail', ['event' => $event]);
    }

    public function kendala()
    {
        return view('admin.maba.kendala.index');
    }

    public function inputNilai()
    {
        return view('admin.maba.nilai.index', ['halaman' => 'utama']);
    }

    public function detailInputNilai($id)
    {
        $user = User::findOrFail($id);
        if (canInputNilai($user))
            return view('admin.maba.nilai.index', ['user' => $user, 'halaman' => 'detail']);
        return redirect()->back();
    }

    public function inputPoin()
    {
        return view('admin.maba.poin.index');
    }

    public function poinUser()
    {
        return view('admin.maba.poin.user.index');
    }

    public function poinKelompok()
    {
        return view('admin.maba.poin.kelompok.index');
    }
}