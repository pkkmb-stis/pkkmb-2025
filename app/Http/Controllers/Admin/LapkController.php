<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use Illuminate\Http\Request;

class LapkController extends Controller
{
    public function kelompok()
    {
        return view('admin.lapk.kelompok.index', ['halaman' => 'utama']);
    }

    public function indikator()
    {
        return view('admin.lapk.indikator.index', ['halaman' => 'utama']);
    }

    public function detailKelompok($id)
    {
        $kelompok = Kelompok::findOrFail($id);
        return view('admin.lapk.kelompok.index', ['halaman' => 'detail', 'kelompok' => $kelompok]);
    }
}
