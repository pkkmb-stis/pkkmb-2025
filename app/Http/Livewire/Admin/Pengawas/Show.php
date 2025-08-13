<?php

namespace App\Http\Livewire\Admin\Pengawas;

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
        'reloadTableLaporanKegiatan' => '$refresh',
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
    public function edit(Publishable $laporanKegiatan)
    {
        $this->selected = $laporanKegiatan->id;
        $this->title = $laporanKegiatan->title;
        $this->link = $laporanKegiatan->link;
        $this->publish_datetime = $laporanKegiatan->publish_datetime;
        $this->openedit = true;
    }

    /**
     * melakukan update pada laporan kegiatan
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

        if (!userHasPermission(PERMISSION_UPDATE_LAPORAN_KEGIATAN))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk update laporan kegiatan', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            Publishable::find($this->selected)
                ->update([
                    'title' => $this->title,
                    'publish_datetime' => $this->publish_datetime,
                    'link' => $this->link
                ]);

            $this->resetAll();
            $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil mengedit laporan kegiatan', 'icon' => 'success', 'iconColor' => 'green']);
        }
    }

    /**
     * hapus laporan kegiatan
     *
     * @param  mixed $id
     * @return void
     */
    public function hapus(Publishable $laporanKegiatan)
    {
        if (!userHasPermission(PERMISSION_DELETE_LAPORAN_KEGIATAN))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menghapus laporan kegiatan', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                $laporanKegiatan->delete();
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menghapus laporan kegiatan', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menambahkan laporan kegiatan', 'icon' => 'error', 'iconColor' => 'red']);
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
     * getLaporanKegiatan berdasarkan filter
     *
     * @param  mixed $search
     * @return void
     */
    private function getLaporanKegiatan($search)
    {
        $query = Publishable::laporanKegiatan()
            ->where('title', 'like', $search);

        // materi yang sudah dipublish adalah laporan kegiatan yang publish datetimenya lebih kecil dari waktu sekarang
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
        return view('admin.pengawas.show', ['laporanKegiatan' => $this->getLaporanKegiatan($search)]);
    }
}
