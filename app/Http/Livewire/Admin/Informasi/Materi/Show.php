<?php

namespace App\Http\Livewire\Admin\Informasi\Materi;

use App\Models\Publishable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $selected;
    public $title, $link, $publish_datetime;
    public $openedit = false;
    public $search;
    public $showModalDetail = false;
    public $isPublished = -1;

    protected $listeners = [
        'reloadTableMateri' => '$refresh',
    ];

    public function resetAll()
    {
        $this->reset('search', 'openedit', 'link', 'publish_datetime', 'title', 'selected');
    }

    /**
     * Untuk memunculkan modal edit dan memilih materi yang akan diedit
     *
     * @param  mixed $mtr
     * @return void
     */
    public function edit(Publishable $materi)
    {
        $this->selected = $materi->id;
        $this->title = $materi->title;
        $this->link = $materi->link;
        $this->publish_datetime = $materi->publish_datetime;
        $this->openedit = true;
    }

    /**
     * melakukan update pada materi
     *
     * @return void
     */
    public function update()
    {
        $this->validate([
            'title' => 'required',
            'publish_datetime' => 'required',
            'link' => 'required'
        ]);

        if (!userHasPermission(PERMISSION_UPDATE_MATERI))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk update materi', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            Publishable::find($this->selected)
                ->update([
                    'title' => $this->title,
                    'publish_datetime' => $this->publish_datetime,
                    'link' => $this->link
                ]);

            $this->resetAll();
            $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil mengedit materi', 'icon' => 'success', 'iconColor' => 'green']);
        }
    }

    /**
     * hapus materi
     *
     * @param  mixed $id
     * @return void
     */
    public function hapus(Publishable $materi)
    {
        if (!userHasPermission(PERMISSION_DELETE_MATERI))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menghapus materi', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                $materi->delete();
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menghapus materi', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menambahkan materi', 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingIsPublished()
    {
        $this->resetPage();
    }

    /**
     * getMateri berdasarkan filter
     *
     * @param  mixed $search
     * @return void
     */
    private function getMateri($search)
    {
        $query = Publishable::materi()
            ->where('title', 'like', $search);

        // materi yang sudah dipublish adalah materi yang publish datetimenya lebih kecil dari waktu sekarang
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
        return view('admin.informasi.materi.show', ['materi' => $this->getMateri($search)]);
    }
}
