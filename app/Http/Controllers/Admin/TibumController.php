<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TibumController extends Controller
{
    public function jenispoin()
    {
        return view('admin.tibum.jenispoin.index');
    }

    public function penebusan()
    {
        return view('admin.tibum.penebusan.index');
    }
}
