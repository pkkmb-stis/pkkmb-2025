<?php

namespace App\Http\Livewire\Admin\Informasi\Materi;

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

        if (!userHasPermission(PERMISSION_ADD_MATERI))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menambah materi', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                Publishable::create([
                    'title' => $this->title,
                    'content' => '-',
                    'link' => $this->link,
                    'publish_datetime' => $this->publish_datetime,
                    'category' => CATEGORY_PUBLISHABLE_MATERI
                ]);

                $this->closeModal();
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil Menambahkan Materi', 'icon' => 'success', 'iconColor' => 'green']);
                $this->emit('reloadTableMateri');
            } catch (\Exception $e) {
                $this->dispatchBrowserEvent('updated', ['title' => $e->getMessage(), 'icon' => 'error', 'iconColor' => 'red']);
            }
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('admin.informasi.materi.add');
    }
}
