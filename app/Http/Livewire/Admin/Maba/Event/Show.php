<?php

namespace App\Http\Livewire\Admin\Maba\Event;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;


class Show extends Component
{
    use WithPagination;

    public $selected = '';
    public $title;
    public $eventcode;
    public $caption;
    public $link;
    public $link_lambat;
    public $is_pasca;
    public $waktu_mulai;
    public $waktu_akhir;
    public $openedit = false;
    public $search;
    public $showModalDetail = false;

    protected $rules = [
        'title' => 'required',
        'is_pasca' => 'required',
        'waktu_mulai' => 'required|date_format:Y-m-d H:i:s',
        'waktu_akhir' => 'required|date_format:Y-m-d H:i:s|after:waktu_mulai',
    ];

    protected $listeners = ['reloadHalamanAbsensi' => '$refresh'];

    /**
     * resetAll input
     *
     * @return void
     */
    public function resetAll()
    {
        $this->reset('search', 'openedit', 'caption', 'caption', 'title', 'link', 'is_pasca', 'waktu_mulai', 'waktu_akhir', 'selected', 'link_lambat');
        $this->resetValidation();
    }

    /**
     * Untuk memunculkan modal edit dan memilih acara yang akan diedit
     *
     * @param  mixed $ev
     * @return void
     */
    public function edit($id)
    {
        $ev = Event::find($id);
        $this->selected = $ev->id;
        $this->title = $ev->title;
        $this->caption = $ev->caption;
        $this->link = $ev->link;
        $this->is_pasca = $ev->getAttributes()['is_pasca'];
        $this->waktu_mulai = $ev->waktu_mulai->toDateTimeString();
        $this->waktu_akhir = $ev->waktu_akhir->toDateTimeString();
        $this->link_lambat = $ev->link_lambat;
        $this->openedit = true;
    }

    /**
     * melakukan update pada event
     *
     * @return void
     */
    public function update()
    {
        $this->validate();

        if (!userHasPermission(PERMISSION_UPDATE_EVENT))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk update event absensi', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                Event::find($this->selected)
                    ->update([
                        'title' => $this->title,
                        'caption' => $this->caption,
                        'link' => $this->link,
                        'is_pasca' => $this->is_pasca,
                        'waktu_mulai' => $this->waktu_mulai,
                        'waktu_akhir' => $this->waktu_akhir,
                        'link_lambat' => $this->link_lambat
                    ]);

                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil mengedit acara', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal mengedit acara', 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
        $this->resetAll();
    }


    /**
     * hapus event
     *
     * @param  mixed $id
     * @return void
     */
    public function hapus($id)
    {
        if (!userHasPermission(PERMISSION_DELETE_EVENT))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk delete event absensi', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                Event::find($id)->delete();
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menghapus acara', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menghapus acara', 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * getEvents berdasarkan pencarian
     *
     * @param  mixed $search
     * @return void
     */
    private function getEvents($search)
    {
        return Event::presensi()
            ->where('title', 'like', $search)
            ->orderBy('created_at', 'desc')
            ->paginate(NUMBER_OF_PAGINATION);
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('admin.maba.event.show', ['event' => $this->getEvents($search)]);
    }
}
