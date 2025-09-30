<?php

namespace App\Http\Livewire\Admin\Informasi\Timeline;

use App\Models\Event;
use Livewire\Component;

class Detail extends Component
{
    public $showModalDetail = false, $canUpdate;
    public $title, $caption, $waktuMulai, $waktuAkhir, $location, $timeline;

    protected $listeners = ['openDetailTimeline'];


    /**
     * dijalankan pertama, untuk mengecek apakah user bisa mengedit timeline
     *
     * @return void
     */
    public function mount()
    {
        $this->canUpdate = userHasPermission(PERMISSION_UPDATE_TIMELINE);
    }

    /**
     * openDetailTimeline modal
     *
     * @param  mixed $timeline
     * @return void
     */
    public function openDetailTimeline(Event $timeline)
    {
        $this->resetValidation();
        $this->timeline = $timeline;
        $this->title = $timeline->title;
        $this->caption = $timeline->caption;
        $this->waktuMulai = $timeline->waktu_mulai;
        $this->waktuAkhir = $timeline->waktu_akhir;
        $this->location = $timeline->location;
        $this->showModalDetail = true;
    }

    /**
     * update timeline
     *
     * @return void
     */
    public function update()
    {
        $this->validate([
            'title' => 'required',
            'waktuMulai' => 'required',
            'location' => 'required',
        ]);

        // Jika waktu akhirnya ada maka pastikan lebih dari waktu awal
        if ($this->waktuAkhir)
            $this->validate(['waktuAkhir' => 'after:waktuMulai']);


        try {
            $this->timeline->update([
                'title' => $this->title,
                'caption' => $this->caption,
                'waktu_mulai' => $this->waktuMulai,
                'waktu_akhir' => $this->waktuAkhir ? $this->waktuAkhir : null,
                'location' => $this->location,
            ]);
            $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil mengubah timeline', 'icon' => 'success', 'iconColor' => 'green']);
            $this->emit('refreshAdminTimeline');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $this->dispatchBrowserEvent('updated', ['title' => 'Gagal mengubah timeline', 'icon' => 'error', 'iconColor' => 'red']);
        }
        $this->showModalDetail = false;
    }

    public function render()
    {
        return view('admin.informasi.timeline.detail');
    }
}
