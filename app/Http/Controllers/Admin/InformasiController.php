<?php

namespace App\Http\Controllers\Admin;

use App\Models\Berita;
use App\Models\Formulir;
use App\Http\Controllers\Controller;

class InformasiController extends Controller
{
    public function gallery()
    {
        return view('admin.informasi.gallery.index');
    }

    public function berita()
    {
        return view('admin.informasi.berita.index');
    }

    public function beritaAdd()
    {
        return view('admin.informasi.berita.form-index', ['halaman' => 'Tambah']);
    }

    public function beritaEdit($id)
    {
        Berita::findOrFail($id);
        return view('admin.informasi.berita.form-index', ['id' => $id, 'halaman' => "Edit"]);
    }

    public function pengumuman()
    {
        return view('admin.informasi.pengumuman.index');
    }

    public function timeline()
    {
        return view('admin.informasi.timeline.index');
    }

    public function faq()
    {
        return view('admin.informasi.faq.index');
    }

    public function formulir()
    {
        return view('admin.informasi.formulir.index');
    }

    public function formulirDetail($id)
    {
        $formulir = Formulir::with('verifications.user')->findOrFail($id);
        return view('admin.informasi.formulir.detail.index', ['formulir' => $formulir]);
    }

    public function materi()
    {
        return view('admin.informasi.materi.index');
    }
}
