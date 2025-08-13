<?php

namespace App\Http\Livewire\Home\Dashboard\Absensi;

use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Card extends Component
{

    protected $listeners = ['refreshCardAbsensi' => '$refresh'];

    /**
     * mengambil data event yang waktu waktu akhir plus 1 jam belum melebihi waktu sekarang
     * orang bisa absen dari waktu mulai absen sampai 1 jam setelah waktu absen
     *
     * @return void
     */
    private function getEvent()
    {
        // return Event::presensi()->whereDoesntHave('user', function (Builder $query) {
        //     $query->where('user_id', auth()->user()->id);
        // })
        //     ->orderBy('waktu_akhir')
        //     ->get()
        //     ->filter(function ($event) {
        //         return eventCanAbsen($event->waktu_mulai, $event->waktu_akhir, 1, 3);
        //     });

        return Event::presensi()
            ->orderBy('waktu_akhir')
            ->get()
            ->filter(function ($event) {
                return eventCanAbsen($event->waktu_mulai, $event->waktu_akhir, 1, 3);
            });
    }

    /**
     * cek metode absen yang akan digunakan
     *
     * @param  mixed $event
     * @return void
     */
    public function absenScan(Event $event)
    {
        // Selalu membuka scanner, tidak peduli waktu
        $this->emit('openScanner', $event->id);

        // Cek waktu setelah scan untuk menentukan tindakan selanjutnya
        $this->emit('postScanCheck', $event->id);
    }

    public function postScanCheck($event_id)
    {
        $event = Event::find($event_id);

        // Jika waktu sudah lewat batas presensi, tapi masih dalam rentang waktu yang diperbolehkan untuk keterlambatan
        if (!eventCanQrCode($event->waktu_mulai, $event->waktu_akhir) && eventCanAbsen($event->waktu_mulai, $event->waktu_akhir, 0, 3)) {
            // Misalnya 1 jam setelah waktu akhir
            $this->emit('formKeterlambatan', $event->id);
        } else if (!eventCanAbsen($event->waktu_mulai, $event->waktu_akhir, 0, 3)) {
            // Jika lewat dari batas toleransi keterlambatan
            $this->dispatchBrowserEvent('updated', [
                'title' => "Kamu tidak bisa melakukan presensi lagi, silakan hubungi Tibum",
                'icon' => 'error',
                'iconColor' => 'red'
            ]);
        }
    }

    /**
     * cek metode absen yang akan digunakan
     *
     * @param  mixed $event
     * @return void
     */
    public function absenForm(Event $event)
    {
        // jika masih dalam rentang waktu mulai dan waktu akhir maka dapat menggunakan qr code
        if (eventCanQrCode($event->waktu_mulai, $event->waktu_akhir)) $this->emit('formKeterlambatan', $event->id);

        //  jika masih dalam rentang 1 jam setelah waktu akhir maka tampilkan form keterlambatan
        else if (eventCanAbsen($event->waktu_mulai, $event->waktu_akhir, 0, 3)) $this->emit('formKeterlambatan', $event->id);

        // jike lambatnya lebih sejam maka tidak bisa absen dari web lagi
        else $this->dispatchBrowserEvent('updated', ['title' => "Kamu tidak bisa melakukan presensi lagi, silakan hubungi Tibum", 'icon' => 'error', 'iconColor' => 'red']);
    }

    public function render()
    {
        return view('home.dashboard.absensi.card', [
            'events' => $this->getEvent()
        ]);
    }
}
