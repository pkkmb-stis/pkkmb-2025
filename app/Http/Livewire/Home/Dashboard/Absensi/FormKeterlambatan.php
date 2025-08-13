<?php

namespace App\Http\Livewire\Home\Dashboard\Absensi;

use App\Events\AbsensiUpdated;
use App\Models\Event;
use App\Models\Poin\Poin;
use App\Models\Kelompok;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormKeterlambatan extends Component
{
    use WithFileUploads;

    public $openFormKeterlambatan = false;
    public $event;
    public $alasan;
    public $nama;
    public $kelompok;
    public $fotoBukti;

    protected $listeners = ['formKeterlambatan'];

    /**
     * merupakan listener untuk menamplkan form keterlambatan
     *
     * @param  mixed $event
     * @return void
     */
    public function formKeterlambatan(Event $event)
    {
        $this->event = $event;
        $this->openFormKeterlambatan = true;
        $this->kelompok = Kelompok::where('lapk_user_id', auth()->user()->id)->get();
    }

    /**
     * resetAll inputan
     *
     * @return void
     */
    public function resetAll()
    {
        $this->reset('openFormKeterlambatan', 'alasan');
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
        // Dipakai jika PKBN-MP2K Hybrid
        // Cek apakah yang login maba atau LAPK
        if (auth()->user()->is_maba) {
            // Jika PKBN-MP2K Online
            // Jika yang login maba
            $this->validate([
                'alasan' => 'required',
            ]);

            if ($this->fotoBukti)
                $this->validate([
                    'fotoBukti' => 'image|max:2048'
                ]);

            $this->openFormKeterlambatan = false;


            $sudahAbsen = DB::table('events_user')
                ->where('event_id', $this->event->id)
                ->where('user_id', auth()->user()->id)
                ->exists();

            // cek lagi apakah sampai dengan waktu dia submit belum melebihi 1 jam setelah waktu absensi berkhir
            if (!eventCanAbsen($this->event->waktu_mulai, $this->event->waktu_akhir, 0, 3))
                $this->dispatchBrowserEvent('updated', ['title' => "Kamu tidak bisa melakukan presensi lagi, silakan hubungi Tibum", 'icon' => 'error', 'iconColor' => 'red']);
            else {
                try {
                    if ($sudahAbsen)
                        $this->dispatchBrowserEvent('updated', ['title' => "Kamu sudah melakukan presensi. Silakan refresh halaman ini", 'icon' => 'error', 'iconColor' => 'red']);
                    else {
                        // cek waktu keterlambatannya berapa menit
                        $keterlambatan = round(Carbon::parse($this->event->waktu_akhir)->floatDiffInMinutes(now()), 0);

                        // tambahi catatan waktu keterlambatannya
                        $alasan = $this->alasan . " (Terlambat {$keterlambatan} menit)";

                        // cek apakah ada foto buktinya atau tidak
                        if ($this->fotoBukti)
                            $bukti = $bukti = $this->fotoBukti->store('absensi');
                        else
                            $bukti = $bukti = null;

                        auth()->user()->event()->attach($this->event, ['status' => 1, 'alasan' => $alasan, 'link' => $bukti]);
                        Poin::insertPoinAbsensi(auth()->user()->id, $this->event); // insert poin absesinya

                        $this->dispatchBrowserEvent('updated', ['title' => "Presensi berhasil", 'icon' => 'success', 'iconColor' => 'green']);
                        // event(new AbsensiUpdated);
                    }

                    $this->emit('refreshCardAbsensi');
                    $this->emit('refreshListAbsensi');
                    // $this->emit('refreshChartDashboard');
                    // $this->emit('refreshListPoinDashboard');
                } catch (\Throwable $th) {
                    dd($th->getMessage());
                    $this->dispatchBrowserEvent('updated', ['title' => "Presensi gagal, coba lagi", 'icon' => 'error', 'iconColor' => 'red']);
                }
            }
            $this->emit('refreshCardAbsensi');
        } else {
            // Jika PKBN-MP2K Offline
            // Jika yang login LAPK
            if (eventCanQrCode($this->event->waktu_mulai, $this->event->waktu_akhir)) {
                $this->validate([
                    'nama' => 'required',
                ]);
            }

            $this->openFormKeterlambatan = false;

            $idMaba = $this->nama;

            $sudahAbsen = DB::table('events_user')
                ->where('event_id', $this->event->id)
                ->where('user_id', $idMaba)
                ->exists();

            // cek lagi apakah sampai dengan waktu dia submit belum melebihi 1 jam setelah waktu absensi berakhir
            if (!eventCanAbsen($this->event->waktu_mulai, $this->event->waktu_akhir, 0, 3))
                $this->dispatchBrowserEvent('updated', ['title' => User::find($idMaba)->name . " tidak bisa melakukan presensi lagi, silakan hubungi Tibum", 'icon' => 'error', 'iconColor' => 'red']);
            else {
                try {
                    if ($sudahAbsen)
                        $this->dispatchBrowserEvent('updated', ['title' => User::find($idMaba)->name . " sudah melakukan presensi. Silakan refresh halaman ini", 'icon' => 'error', 'iconColor' => 'red']);
                    else {
                        if (!eventCanQrCode($this->event->waktu_mulai, $this->event->waktu_akhir)) {
                            $this->emit('autoFormKeterlambatan', $this->event->id, $idMaba);
                        } else {
                            User::find($idMaba)->event()->attach($this->event, ['status' => 0]);
                            $this->dispatchBrowserEvent('updated', ['title' => "Presensi " . User::find($idMaba)->name . " berhasil", 'icon' => 'success', 'iconColor' => 'green']);
                        }
                    }

                    $this->emit('refreshCardAbsensi');
                    $this->emit('refreshListAbsensi');

                } catch (\Throwable $th) {
                    dd($th->getMessage());
                    $this->dispatchBrowserEvent('updated', ['title' => "Presensi gagal, coba lagi", 'icon' => 'error', 'iconColor' => 'red']);
                }
            }
            $this->emit('refreshCardAbsensi');
        }
    }

    public function render()
    {
        return view('home.dashboard.absensi.form-keterlambatan');
    }
}