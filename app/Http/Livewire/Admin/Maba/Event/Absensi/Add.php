<?php

namespace App\Http\Livewire\Admin\Maba\Event\Absensi;

use App\Events\AbsensiUpdated;
use App\Models\Event;
use App\Models\User;
use Livewire\Component;

class Add extends Component
{
    public $event;
    public $showModalAddAbsensi = false;
    public $user;
    public $keterangan;
    public $statusAbsensi;

    protected $listeners = ['openModalAddAbsensi'];

    /**
     * listeners untuk buka modal add absensi
     *
     * @param  mixed $user
     * @param  mixed $event
     * @return void
     */
    public function openModalAddAbsensi(User $user, Event $event)
    {
        $this->event = $event;
        $this->user = $user;
        $this->showModalAddAbsensi = true;
    }

    /**
     * resetAll input
     *
     * @return void
     */
    public function resetAll()
    {
        $this->reset('showModalAddAbsensi', 'user', 'keterangan', 'statusAbsensi');
        $this->resetValidation();
    }

    /**
     * addA new absensi
     *
     * @return void
     */
    public function addAbsensi()
    {
        $this->validate(['statusAbsensi' => 'required']);
        if (userHasPermission(PERMISSION_UPDATE_ABSENSI) && (now() > $this->event->waktu_akhir)) {
            try {
                $this->user->event()->attach($this->event, [
                    'alasan' => $this->keterangan,
                    'status' => $this->statusAbsensi
                ]);

                $this->resetAll();
                event(new AbsensiUpdated);
                $this->dispatchBrowserEvent('updated', ['title' => 'Absensi berhasil ditambah', 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Absensi gagal ditambah', 'icon' => 'error', 'iconColor' => 'red']);
            }
        } else {
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menambah data absensi', 'icon' => 'error', 'iconColor' => 'red']);
        }
    }

    public function render()
    {
        return view('admin.maba.event.absensi.add');
    }
}
