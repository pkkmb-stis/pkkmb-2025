<?php

namespace App\Http\Livewire\Admin\Maba\Event\Absensi;


use App\Models\Event;
use App\Models\Kelompok;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $event;
    public $kelompokSearch = '%%';
    public $namaSearch;
    public $belumAbsen = 1;
    public $kelompok;
    public $statusAbsensi = -1; // berarti semua status
    public $isMaba = 1;
    public $canAddNewAbsen = false;

    protected $listeners = [
        'echo-private:absensi,AbsensiUpdated' => '$refresh'
    ];

    /**
     * ambil data yang diperlukan
     *
     * @param  mixed $event
     * @return void
     */
    public function mount(Event $event)
    {
        $this->event = $event;
        $this->kelompok = Kelompok::all()->pluck('nama');
    }

    /**
     * hapus data presensi, maka user tersebut akan masuk kedalam list yang belum absen
     *
     * @param  mixed $user
     * @return void
     */
    public function hapus($user, $link)
    {
        if (!userHasPermission(PERMISSION_DELETE_ABSENSI))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menghapus data presensi', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                if (!empty($link))
                    Storage::delete($link);

                $this->event->user()->detach($user);
                $this->dispatchBrowserEvent('updated', ['title' => "Berhasil menghapus data presensi", 'icon' => 'success', 'iconColor' => 'green']);
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menghapus data presensi', 'icon' => 'error', 'iconColor' => 'red']);
            }
        }
    }

    public function updating($propertyName)
    {
        if (in_array($propertyName, ['kelompokSearch', 'namaSearch', 'belumAbsen', 'statusAbsensi', 'isMaba'])) {
            $this->resetPage();
        }
    }

    /**
     * getAbsensiUser sesuai filter
     *
     * @return void
     */
    private function getAbsensiUser()
    {
        //  Mengambil data yang belum absen. User yang belum absen berarti user yang user_id nya belum ada ditabel events_user
        if ($this->belumAbsen) {
            $query = User::whereDoesntHave('event', function (Builder $query) {
                $query->where('event_id', $this->event->id);
            });
        } else {
            $query = User::join('events_user AS eu', 'eu.user_id', '=', 'users.id')
                ->where('eu.event_id', $this->event->id)
                ->orderBy('eu.created_at', 'desc')
                ->select('users.*', 
                        'eu.status as attendance_status', 
                        'eu.created_at as attendance_created_at',
                        'eu.link as link',
                        'eu.user_id as user_id',
                        'eu.event_id as event_id');

            if ($this->statusAbsensi != -1)
                $query = $query->where('eu.status', $this->statusAbsensi);
        }


        // Untuk memfilter maba ataupun panitia
        if ($this->isMaba == 1) {
            // Mencari berdasarkan kelompok
            $query = $query->whereHas('kelompok', function (Builder $query) {
                $query->where('nama', 'like', $this->kelompokSearch);
            });
        } else {
            $query = $query->role(ROLE_PANITIA);
        }

        return $query
            ->where(function ($query) {
                $namaSearch = '%' . $this->namaSearch . '%';
                $query->where('name', 'like', $namaSearch)
                    ->orWhere('users.username', 'like', $namaSearch)
                    ->orWhere('users.nimb', 'like', $namaSearch);
            })
            ->orderby('name')
            ->paginate(NUMBER_OF_PAGINATION);
    }


    public function render()
    {
        // bisa add new absen ketika sekrang lebih besar daripada waktu akhir absensi menggunakan qr code
        $this->canAddNewAbsen = userHasPermission(PERMISSION_UPDATE_ABSENSI) && (now() > $this->event->waktu_akhir);
        return view('admin.maba.event.absensi.table', ['users' => $this->getAbsensiUser()]);
    }
}
