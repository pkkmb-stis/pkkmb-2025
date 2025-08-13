<?php

namespace App\Http\Livewire\Admin\Maba\Event\Absensi;

use App\Events\AbsensiUpdated;
use App\Models\User;
use Livewire\Component;

class Detail extends Component
{
    public $user;
    public $idEvent;
    public $createdAt;
    public $showModalDetail = false;
    public $keterangan;
    public $statusAbsensi;
    public $canEdit;
    public $bukti;

    protected $listeners = [
        'openModalDetailAbsensi' => 'openModalDetailAbsensi'
    ];

    /**
     * openModalDetailAbsensi listeners
     *
     * @param  mixed $user
     * @param  mixed $idEvent
     * @return void
     */
    public function openModalDetailAbsensi(User $user, $idEvent)
    {
        $this->canEdit = userHasPermission(PERMISSION_UPDATE_ABSENSI);
        $absensi = $user->event()->withPivotValue('event_id', $idEvent)->first()->pivot;
        $this->createdAt = $absensi->created_at;
        $this->statusAbsensi = $absensi->status;
        $this->keterangan = $absensi->alasan;
        $this->bukti = $absensi->link;

        $this->user = $user;
        $this->showModalDetail = true;
        $this->idEvent = $idEvent;
    }

    public function update()
    {
        if (!$this->canEdit)
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk edit data absensi', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                $this->user->event()->updateExistingPivot($this->idEvent, [
                    'alasan' => $this->keterangan,
                    'status' => $this->statusAbsensi
                ]);

                event(new AbsensiUpdated);
                $this->showModalDetail = false;
                $this->dispatchBrowserEvent('updated', ['title' => "Data absensi berhasil diubah", 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => "Data absensi gagal diubah", 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
    }

    public function render()
    {
        return view('admin.maba.event.absensi.detail');
    }
}
