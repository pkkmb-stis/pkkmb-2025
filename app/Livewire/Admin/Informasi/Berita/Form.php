<?php

namespace App\Livewire\Admin\Informasi\Berita;

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
        if (!userHasPermission(PERMISSION_ADD_BERITA)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk menambah berita', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        // Validate first before any operations
        $this->validateThumbnails();

        try {
            // Upload file
            $file = $this->thumbnails->store('thumbnails');
            
            if (!$file) {
                throw new \Exception('Gagal mengupload thumbnail');
            }

            // Create berita
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
            
            $this->dispatch('updated', 
                title: 'Berhasil menyimpan berita', 
                icon: 'success', 
                iconColor: 'green'
            );
            
        } catch (\Exception $e) {
            \Log::error('Add Berita Error: ' . $e->getMessage());
            
            // Cleanup uploaded file if berita creation failed
            if (isset($file) && $file) {
                \Storage::delete($file);
            }
            
            $this->dispatch('updated', 
                title: 'Gagal menyimpan berita', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }


    /**
     * update berita
     *
     * @return void
     */
private function update()
{
    if (!userHasPermission(PERMISSION_UPDATE_BERITA)) {
        $this->dispatch('updated', 
            title: 'Kamu tidak memiliki akses untuk update berita', 
            icon: 'error', 
            iconColor: 'red'
        );
        return;
    }

    $berita = Berita::find($this->idBerita);
    
    if (!$berita) {
        $this->dispatch('updated', 
            title: 'Berita tidak ditemukan', 
            icon: 'error', 
            iconColor: 'red'
        );
        return;
    }

    $file = $berita->thumbnails; // Default to existing file
    $oldThumbnail = $berita->thumbnails;
    $newFileUploaded = null;

    // Handle thumbnail upload if new file provided
    if (!$this->thumbnailsLama) {
        try {
            $this->validateThumbnails();
            
            // Upload new file first
            $newFileUploaded = $this->thumbnails->store('thumbnails');
            
            if (!$newFileUploaded) {
                throw new \Exception('Gagal mengupload thumbnail baru');
            }
            
            $file = $newFileUploaded;
            
        } catch (\Exception $e) {
            $this->dispatch('updated', 
                title: 'Gagal mengupload thumbnail: ' . $e->getMessage(), 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }
    }

    try {
        $berita->update([
            'judul' => $this->judul,
            'published_by' => $this->penulis,
            'content' => $this->konten,
            'category' => $this->kategori,
            'slug' => $this->generateUniqueSlug($this->judul, $berita->id),
            'published_datetime' => $this->waktuPublish,
            'hastag' => $this->hastags,
            'thumbnails' => $file
        ]);

        // Only delete old file if update successful and new file uploaded
        if ($newFileUploaded && $oldThumbnail && $oldThumbnail !== $newFileUploaded) {
            Storage::delete($oldThumbnail);
        }
        
        $this->dispatch('updated', 
            title: 'Berhasil menyimpan berita', 
            icon: 'success', 
            iconColor: 'green'
        );
        
    } catch (\Exception $e) {
        \Log::error('Update Berita Error: ' . $e->getMessage());
        
        // Cleanup new uploaded file if update failed
        if ($newFileUploaded) {
            Storage::delete($newFileUploaded);
        }
        
        $this->dispatch('updated', 
            title: 'Gagal menyimpan berita', 
            icon: 'error', 
            iconColor: 'red'
        );
    }
}

private function generateUniqueSlug($title, $excludeId = null)
{
    $slug = Str::slug($title);
    $originalSlug = $slug;
    $count = 1;
    
    $query = Berita::where('slug', $slug);
    if ($excludeId) {
        $query->where('id', '!=', $excludeId);
    }
    
    while ($query->exists()) {
        $slug = $originalSlug . '-' . $count;
        $count++;
        $query = Berita::where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
    }
    
    return $slug;
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
