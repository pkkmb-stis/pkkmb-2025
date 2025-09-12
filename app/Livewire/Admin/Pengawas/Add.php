<?php

namespace App\Livewire\Admin\Pengawas;

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

        if (!userHasPermission(PERMISSION_ADD_LAPORAN_KEGIATAN)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk menambah laporan kegiatan', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            Publishable::create([
                'title' => $this->title,
                'content' => '-',
                'link' => $this->link,
                'publish_datetime' => $this->publish_datetime,
                'category' => CATEGORY_PUBLISHABLE_LAPORAN_KEGIATAN
            ]);

            $this->closeModal();

            $this->dispatch('updated', 
                title: 'Berhasil Menambahkan Laporan Kegiatan', 
                icon: 'success', 
                iconColor: 'green'
            );

            $this->dispatch('reloadTableLaporanKegiatan');
            
        } catch (\Exception $e) {
            // Log error untuk debugging, jangan expose ke user
            \Log::error('Error creating laporan kegiatan: ' . $e->getMessage());
            
            $this->dispatch('updated', 
                title: 'Gagal menambahkan laporan kegiatan', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }


    public function render()
    {
        return view('admin.pengawas.add');
    }
}
