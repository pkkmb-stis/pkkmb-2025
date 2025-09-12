<?php

namespace App\Livewire\Home\Dashboard\Absensi;

use App\Events\AbsensiUpdated;
use App\Models\Event;
use App\Models\Poin\Poin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class AutoFormKeterlambatan extends Component
{
    use WithFileUploads;

    public $openAutoFormKeterlambatan = false;
    public $event;
    public $user;
    public $nama;
    public $alasan;
    public $fotoBukti;
    public $kehadiran;
    public $isPanitia;

    /**
     * merupakan listener untuk menamplkan form keterlambatan
     *
     * @param  mixed $event
     * @return void
     */
    #[On('autoFormKeterlambatan')]
    public function autoFormKeterlambatan($event_id, $user_id)
    {
        $this->event = Event::find($event_id);
        $this->user = User::find($user_id);
        $this->nama = $this->user->id;
        $this->isPanitia = !$this->user->is_maba;
        $this->openAutoFormKeterlambatan = true;
    }

    public function setKehadiran($value)
    {
        $this->kehadiran = $value;

        // Reset alasan jika kembali memilih "Tepat Waktu"
        if ($this->kehadiran === 'tepat_waktu') {
            $this->alasan = null;
        }
    }

    /**
     * resetAll inputan
     *
     * @return void
     */
    public function resetAll()
    {
        $this->reset('openAutoFormKeterlambatan', 'alasan', 'kehadiran');
        $this->resetValidation();
    }

    /**
     * validasi foto bukti
     *
     * @return void
     */
    public function updatedFotoBukti()
    {
        $this->validate(['fotoBukti' => 'image|max:2048']);
    }

    /**
     * submit form keterlamvatan
     *
     * @return void
     */
    public function submit()
    {
        $this->validate([
            'kehadiran' => 'required',
            'alasan' => $this->kehadiran !== 'tepat_waktu' ? 'required' : 'nullable',
            'fotoBukti' => 'nullable|image|max:2048'
        ]);

        $this->openAutoFormKeterlambatan = false;

        $idMaba = $this->nama;

        $sudahAbsen = DB::table('events_user')
            ->where('event_id', $this->event->id)
            ->where('user_id', $idMaba)
            ->exists();

        // cek lagi apakah sampai dengan waktu dia submit belum melebihi 1 jam setelah waktu absensi berakhir
        if (!eventCanAbsen($this->event->waktu_mulai, $this->event->waktu_akhir, 0, 3)) {
            $this->dispatch('updated', 
                title: $this->user->name . " tidak bisa melakukan presensi lagi, silakan hubungi Tibum",
                icon: 'error',
                iconColor: 'red'
            );
            return;
        } else {
            try {
                if ($sudahAbsen) {
                    $this->dispatch('updated',
                        title: $this->user->name . " sudah melakukan presensi. Silakan refresh halaman ini",
                        icon: 'error',
                        iconColor: 'red'
                    );
                } else {
                    $status = 1;
                    $kategoriTerlambat = '';
                    $alasan = $this->alasan;

                    switch ($this->kehadiran) {
                        case 'tepat_waktu':
                            $status = 0;
                            $kategoriTerlambat = 'Tepat Waktu';
                            $alasan = "Tepat waktu";
                            break;
                        case 'terlambat_0_10':
                            $kategoriTerlambat = '0-10 menit';
                            $alasan .= " (Terlambat 0-10 menit)";
                            break;
                        case 'terlambat_10_15':
                            $kategoriTerlambat = '10-15 menit';
                            $alasan .= " (Terlambat 10-15 menit)";
                            break;
                        case 'terlambat_0_15':
                            $kategoriTerlambat = '0-15 menit';
                            $alasan .= " (Terlambat 0-15 menit)";
                            break;
                        case 'terlambat_15_30':
                            $kategoriTerlambat = '15-30 menit';
                            $alasan .= " (Terlambat 15-30 menit)";
                            break;
                        case 'terlambat_lebih_30':
                            $kategoriTerlambat = '> 30 menit';
                            $alasan .= " (Terlambat lebih dari 30 menit)";
                            break;
                    }

                    // Save data to the database
                    $bukti = $this->fotoBukti ? $this->fotoBukti->store('absensi') : null;
                    $this->user->event()->attach($this->event, ['status' => $status, 'alasan' => $alasan, 'link' => $bukti]);

                    // Insert points based on lateness category
                    Poin::insertPoinAbsensiManual($this->user->id, $this->event, $kategoriTerlambat);

                    $this->dispatch('updated',
                        title: "Presensi " . $this->user->name . " berhasil",
                        icon: 'success',
                        iconColor: 'green'
                    );

                    // Reset all relevant properties
                    $this->resetAll();
                }

                $this->dispatch('refreshCardAbsensi');
                $this->dispatch('refreshListAbsensi');
            } catch (\Throwable $th) {
                $this->dispatch('updated',
                    title: "Presensi gagal, coba lagi",
                    icon: 'error',
                    iconColor: 'red'
                );
            }
        }
    }

    public function render()
    {
        return view('home.dashboard.absensi.auto-form-keterlambatan');
    }
}
