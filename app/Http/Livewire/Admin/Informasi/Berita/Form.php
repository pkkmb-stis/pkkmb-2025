<?php

namespace App\Http\Livewire\Admin\Informasi\Berita;

use App\Models\Berita;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $konten, $thumbnails, $waktuPublish, $judul, $hastags, $kategori, $penulis, $idBerita, $thumbnailsLama;

    protected $rules = [
        'judul' => 'required',
        'penulis' => 'required',
        'konten' => 'required',
        'kategori' => 'required',
        'waktuPublish' => 'required',
    ];

    /**
     * initialisasi component
     *
     * @param  mixed $id
     * @return void
     */
    public function mount($id = null)
    {
        // JIka id nya ada berarti halaman edit
        if ($id) {
            $berita = Berita::find($id);
            $this->judul = $berita->judul;
            $this->penulis = $berita->published_by;
            $this->konten = $berita->content;
            $this->waktuPublish = $berita->published_datetime;
            $this->hastags = $berita->hastag;
            $this->thumbnailsLama = storage($berita->thumbnails);
            $this->kategori = $berita->category;
        }
        $this->idBerita = $id;
    }

    /**
     * validateThumbnails
     *
     * @return void
     */
    private function validateThumbnails()
    {
        $this->validate(['thumbnails' => 'image|max:2048']);
    }

    /**
     * updatedThumbnails hingga bisa di preview
     *
     * @return void
     */
    public function updatedThumbnails()
    {
        if ($this->thumbnails) {
            $this->validateThumbnails();
            $this->thumbnailsLama = null;
        }
    }

    /**
     * add new berita
     *
     * @return void
     */
    private function add()
    {
        if (!userHasPermission(PERMISSION_ADD_BERITA))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menambah berita', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            $this->validateThumbnails();
            $file = $this->thumbnails->store('thumbnails');

            try {
                $berita = Berita::create([
                    'judul' => $this->judul,
                    'published_by' => $this->penulis,
                    'content' => $this->konten,
                    'category' => $this->kategori,
                    'slug' => Str::slug($this->judul),
                    'published_datetime' => $this->waktuPublish,
                    'hastag' => $this->hastags,
                    'thumbnails' => $file
                ]);

                $this->idBerita = $berita->id;
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menyimpan berita', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Exception $e) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menyimpan Berita', 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
    }

    /**
     * update berita
     *
     * @return void
     */
    private function update()
    {
        if (!userHasPermission(PERMISSION_UPDATE_BERITA))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk update berita', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            $berita = Berita::find($this->idBerita);
            if ($this->thumbnailsLama)
                $file = $berita->thumbnails;
            else {
                $this->validateThumbnails();

                Storage::delete($berita->thumbnails);
                $file = $this->thumbnails->store('thumbnails');
            }

            try {
                $berita->update([
                    'judul' => $this->judul,
                    'published_by' => $this->penulis,
                    'content' => $this->konten,
                    'category' => $this->kategori,
                    'slug' => Str::slug($this->judul),
                    'published_datetime' => $this->waktuPublish,
                    'hastag' => $this->hastags,
                    'thumbnails' => $file
                ]);

                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menyimpan berita', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Exception $e) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menyimpan Berita', 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
    }

    /**
     * method untuk mengarahkan tindakan apakah add atau update berdasarkan ada tidaknya id berita. Ini dilakuka karena komponen ini digunakan di dua view
     *
     * @return void
     */
    public function submit()
    {
        $this->validate();
        if ($this->idBerita) $this->update();
        else $this->add();
    }

    public function render()
    {
        return view('admin.informasi.berita.form');
    }
}
