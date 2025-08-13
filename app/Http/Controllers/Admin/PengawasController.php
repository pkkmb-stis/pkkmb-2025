<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengawasController extends Controller
{
    public function laporanKegiatan()
    {
        return view('admin.pengawas.index');
    }
}