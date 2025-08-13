<?php

namespace App\Http\Livewire\Admin\Pengawas;

use App\Models\Publishable;
use Livewire\Component;

class Add extends Component
{
    public $title;
    public $link;
    public $valid = false;
    public $publish_datetime;
    public $isModalOpen = false;

    /**
     * closeModal add materi
     *
     * @return void
     */
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->reset('title', 'link', 'publish_datetime');
        $this->resetValidation();
        $this->valid = false;
    }

    /**
     * add new materi
     *
     * @return void
     */
    public function submit()
    {
        $this->validate([
            'title' => 'required',
            'publish_datetime' => 'required|date_format:Y-m-d H:i:s',
            'link' => 'required'
        ]);

        if (!userHasPermission(PERMISSION_ADD_LAPORAN_KEGIATAN))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menambah laporan kegiatan', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                Publishable::create([
                    'title' => $this->title,
                    'content' => '-',
                    'link' => $this->link,
                    'publish_datetime' => $this->publish_datetime,
                    'category' => CATEGORY_PUBLISHABLE_LAPORAN_KEGIATAN
                ]);

                $this->closeModal();
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil Menambahkan Laporan Kegiatan', 'icon' => 'success', 'iconColor' => 'green']);
                $this->emit('reloadTableLaporanKegiatan');
            } catch (\Exception $e) {
                $this->dispatchBrowserEvent('updated', ['title' => $e->getMessage(), 'icon' => 'error', 'iconColor' => 'red']);
            }
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('admin.pengawas.add');
    }
}
