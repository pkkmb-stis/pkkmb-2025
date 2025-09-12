<?php

namespace App\Livewire\Admin\Informasi\Pengumuman;

use Livewire\Component;
use App\Models\Publishable;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

class Table extends Component
{
    use WithPagination, WithFileUploads;

    private $PAGINATION = 1;
    private $pengumuman;

    public $selected = '';
    public $title, $content, $publish_datetime;
    public $openedit = false;
    public $search;
    public $pengumumanToShow;
    public $showModalDetail = false;
    public $isPublished = -1;
    public $image, $filename;

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'publish_datetime' => 'required|date_format:Y-m-d H:i:s',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    /**
     * resetAll variabel
     *
     * @return void
     */
    public function resetAll()
    {
        $this->reset('search', 'openedit', 'content', 'publish_datetime', 'title', 'selected','image');
        $this->resetValidation();
    }

    /**
     * Untuk memunculkan modal edit dan memilih pengumuman yang akan diedit
     *
     * @param  mixed $p
     * @return void
     */
    public function edit($id)
    {
        $p = Publishable::pengumuman()->find($id);
        $this->selected = $p->id;
        $this->title = $p->title;
        $this->publish_datetime = $p->publish_datetime->toDateTimeString();
        $this->content = $p->content;
        $this->filename = $p->image;
        $this->openedit = true;
    }

    /**
     * melakukan update pada pengumuman
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        
        if (!userHasPermission(PERMISSION_UPDATE_PENGUMUMAN)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk update pengumuman', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            if ($this->image != null) {
                $oldFile = 'images/upload-pengumuman/' . $this->filename;
                if (Storage::disk('public')->exists($oldFile)) {
                    Storage::disk('public')->delete($oldFile);
                }
                
                $this->filename = sha1(uniqid(mt_rand(), true)) . '.' . $this->image->getClientOriginalExtension();
                $this->image->storeAs('images/upload-pengumuman', $this->filename, 'public');
            }

            $pengumuman = Publishable::pengumuman()->find($this->selected);
            
            if (!$pengumuman) {
                $this->dispatch('updated', 
                    title: 'Pengumuman tidak ditemukan', 
                    icon: 'error', 
                    iconColor: 'red'
                );
                return;
            }

            $pengumuman->update([
                'title' => $this->title,
                'publish_datetime' => $this->publish_datetime,
                'content' => $this->content,
                'image' => $this->filename
            ]);
            
            $this->dispatch('updated', 
                title: 'Berhasil Mengedit Pengumuman', 
                icon: 'success', 
                iconColor: 'green'
            );
            
            $this->dispatch('reloadTable');
            
        } catch (\Throwable $th) {
            $this->dispatch('updated', 
                title: 'Update gagal', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
        
        $this->resetAll();
    }

    /**
     * untuk memunculkan popup detail pengumiman
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $this->pengumumanToShow = Publishable::pengumuman()->find($id);
        $this->showModalDetail = true;
    }

    /**
     * hapus pengumuman
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        if (!userHasPermission(PERMISSION_DELETE_PENGUMUMAN)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk menghapus pengumuman', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $p = Publishable::pengumuman()->find($id);
            
            if (!$p) {
                $this->dispatch('updated', 
                    title: 'Pengumuman tidak ditemukan', 
                    icon: 'error', 
                    iconColor: 'red'
                );
                return;
            }

            if ($p->image && \Storage::disk('public')->exists('images/upload-pengumuman/' . $p->image)) {
                \Storage::disk('public')->delete('images/upload-pengumuman/' . $p->image);
            }
            
            $p->delete();
            $this->search = '';
            
            $this->dispatch('updated', 
                title: 'Berhasil Menghapus Pengumuman', 
                icon: 'success', 
                iconColor: 'green'
            );
            
        } catch (\Throwable $th) {
            $this->dispatch('updated', 
                title: 'Gagal Menghapus Pengumuman',
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    #[On('reloadTable')]
    public function refresh()
    {
        // Magic method $refresh() sekarang menjadi method explicit
    }

    private function getPengumuman($search)
    {
        $query = Publishable::pengumuman()
            ->where('title', 'like', $search);

        if ($this->isPublished == 1) {
            $query = $query->where('publish_datetime', '<=', DB::raw(rawSQLDateTime()));
        } else if ($this->isPublished == 0) {
            $query = $query->where('publish_datetime', '>', DB::raw(rawSQLDateTime()));
        }

        return $query->orderBy('publish_datetime', 'desc')
            ->paginate(NUMBER_OF_PAGINATION);
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('admin.informasi.pengumuman.table', ['pengumuman' => $this->getPengumuman($search)]);
    }
}
