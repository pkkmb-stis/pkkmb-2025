<?php

namespace App\Livewire\Home\Dashboard\Absensi;

use App\Events\AbsensiUpdated;
use App\Models\Event;
use App\Models\Poin\Poin;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;

class QrcodeReader extends Component
{
    public $openQrCodeReader = false;
    public $event;

    /**
     * listener untuk membuka scanner
     *
     * @param  mixed $event
     * @return void
     */
    #[On('openScanner')]
    public function openScanner(Event $event)
    {
        $this->event = $event;
        $this->openQrCodeReader = true;
    }

    /**
     * submit absensi qr code
     *
     * @param  mixed $code
     * @return void
     */
    #[On('absensiWithQrCode')]
    public function absensiWithQrCode($code)
    {
        $this->openQrCodeReader = false;

        //Code sebelumnya

        // Dipakai jika PKBN-MP2K Hybrid
        // Cek apakah yang login maba atau LAPK
        if (auth()->user()->is_maba) {
            // Jika PKBN-MP2K Online
            // Jika yang login maba
            $sudahAbsen = DB::table('events_user')
                ->where('event_id', $this->event->id)
                ->where('user_id', auth()->user()->id)
                ->exists();

            // Dipakai jika PKBN-MP2K Online
            // Cek apakah masih bisa melakukan qrr code juka tidak maka buka form keterlambatan
            if (!eventCanQrCode($this->event->waktu_mulai, $this->event->waktu_akhir)) {
                $this->dispatch('updated', 
                    title: "Kamu sudah terlambat, silakan isi form keterlambatan untuk melakukan presensi", 
                    icon: 'error', 
                    iconColor: 'red'
                );
                $this->dispatch('formKeterlambatan', $this->event->id);
            } else if ($this->event->eventcode != $code)
                // Cek apakah event code yag discanner sudah bener atau tidak
                $this->dispatch('updated', 
                    title: "QR code tidak sesuai untuk absensi " . $this->event->title, 
                    icon: 'error', 
                    iconColor: 'red'
                );
            else {
                try {
                    if ($sudahAbsen)
                        $this->dispatch('updated', 
                            title: "Kamu sudah melakukan presensi. Silakan refresh halaman ini", 
                            icon: 'error', 
                            iconColor: 'red'
                        );
                    else {
                        auth()->user()->event()->attach($this->event, ['status' => 0]);

                        // jika maba yang absen maka insert poin penghargaan karena tepat waktu
                        if (auth()->user()->is_maba)
                            Poin::insertPoinAbsensi(auth()->user()->id, $this->event);
                        $this->dispatch('updated', 
                            title: "Presensi berhasil", 
                            icon: 'success', 
                            iconColor: 'green'
                        );
                        // event(new AbsensiUpdated);
                    }

                    $this->dispatch('refreshCardAbsensi');
                    $this->dispatch('refreshListAbsensi');

                    // $this->dispatch('refreshChartDashboard');
                    // $this->dispatch('refreshListPoinDashboard');
                } catch (\Throwable $th) {
                    $this->dispatch('updated', 
                        title: "Presensi gagal, coba lagi", 
                        icon: 'error', 
                        iconColor: 'red'
                    );
                }
            }
        } else {
            // Jika PKBN-MP2K Offline
            // Jika yang login LAPK
            $userAda = DB::table('users')
                ->where('username', $code)
                ->exists();

            // Dipakai jika PKBN-MP2K Offline

            if (!($userAda)) {
                // cek apakah code maba/miba yag discanner sudah bener atau tidak
                $this->dispatch('updated', 
                    title: "QR code tidak sesuai untuk absensi" . $this->event->title, 
                    icon: 'error', 
                    iconColor: 'red'
                );
            } else if (!eventCanQrCode($this->event->waktu_mulai, $this->event->waktu_akhir)) {
                // cek apakah sudah melewati jam presensi atau belum, jika sudah maka buka form keterlambatan setelah scan
                $user = DB::table('users')
                    ->where('username', $code)
                    ->first();
                // Cek apakah maba sudah absen atau belum
                $sudahAbsen = DB::table('events_user')
                    ->where('event_id', $this->event->id)
                    ->where('user_id', $user->id)
                    ->exists();
                if ($sudahAbsen) {
                    $this->dispatch('updated', 
                        title: $user->name . " sudah melakukan presensi. Silakan refresh halaman ini", 
                        icon: 'error', 
                        iconColor: 'red'
                    );
                } else {
                    $this->dispatch('autoFormKeterlambatan', $this->event->id, $user->id);
                }
            } else {
                // Ambil data maba dengan username
                $user = DB::table('users')
                    ->where('username', $code)
                    ->first();
                // Cek apakah maba sudah absen atau belum
                $sudahAbsen = DB::table('events_user')
                    ->where('event_id', $this->event->id)
                    ->where('user_id', $user->id)
                    ->exists();
                try {
                    if ($sudahAbsen)
                        $this->dispatch('updated', 
                            title: $user->name . " sudah melakukan presensi. Silakan refresh halaman ini", 
                            icon: 'error', 
                            iconColor: 'red'
                        );
                    else {
                        User::find($user->id)->event()->attach($this->event, ['status' => 0]);

                        // jika maba diabsen oleh PK maka insert poin penghargaan karena tepat waktu
                        Poin::insertPoinAbsensi($user->id, $this->event);
                        $this->dispatch('updated', 
                            title: "Presensi " . $user->name . " berhasil", 
                            icon: 'success', 
                            iconColor: 'green'
                        );
                        // event(new AbsensiUpdated);
                    }

                    $this->dispatch('refreshCardAbsensi');
                    $this->dispatch('refreshListAbsensi');

                    // $this->dispatch('refreshChartDashboard');
                    // $this->dispatch('refreshListPoinDashboard');
                } catch (\Throwable $th) {
                    $this->dispatch('updated', 
                        title: "Presensi " . $user->name . " gagal, coba lagi", 
                        icon: 'error', 
                        iconColor: 'red'
                    );
                }
            }
        }
    }

    public function render()
    {
        return view('home.dashboard.absensi.qrcode-reader');
    }
}
