<?php

namespace App\Http\Livewire\Admin\Informasi\Pengumuman;

use Livewire\Component;
use App\Models\Publishable;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


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

    protected $listeners = [
        'reloadTable' => '$refresh',
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
        if (!userHasPermission(PERMISSION_UPDATE_PENGUMUMAN))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk update pengumuman', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                if ($this->image != null) {
                    Storage::disk('public')->delete('images/upload-pengumuman/' . $this->filename);
                    $this->filename = sha1(uniqid(mt_rand(), true)) . '.' . $this->image->getClientOriginalExtension();
                    $this->image->storeAs('images/upload-pengumuman', $this->filename, 'public');
                }

                Publishable::pengumuman()
                    ->find($this->selected)
                    ->update([
                        'title' => $this->title,
                        'publish_datetime' => $this->publish_datetime,
                        'content' => $this->content,
                        'image' => $this->filename
                    ]);
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil Mengedit Pengumuman', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Update gagal', 'icon' => 'error', 'iconColor' => 'red']);
            }
            $this->resetAll();
        }
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
        if (!userHasPermission(PERMISSION_DELETE_PENGUMUMAN))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menghapus pengumuman', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                $p = Publishable::pengumuman()->find($id);
                if ($p->image && \Storage::disk('public')->exists('images/upload-pengumuman/' . $p->image)) {
                    \Storage::disk('public')->delete('images/upload-pengumuman/' . $p->image);
                }
                $p->delete();
                $this->search = '';
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil Menghapus Pengumuman', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal Menambahkan Pengumuman', 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
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
