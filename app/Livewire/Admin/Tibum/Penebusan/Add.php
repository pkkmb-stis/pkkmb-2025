<?php

namespace App\Livewire\Admin\Tibum\Penebusan;

use App\Models\Poin\JenisPoin;
use App\Models\Poin\Penebusan;
use App\Models\Poin\Poin;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;


class Add extends Component
{
    use WithFileUploads;
    public $users, $poin, $poin_id, $status, $deadline, $jenispoin, $file, $accepted_at, $taken_at, $submited_at;
    public $jenispoins, $allMaba;

    protected $rules = [
        'deadline' => 'nullable',
        'status' => 'required|exists:penebusan_user,status',
        'jenispoin' => 'required|exists:jenis_poin,id',
        'users' => 'required|array',
        'file' => 'nullable|max:5120'
    ];

    /**
     * mount, yang pertama dijalanin
     *
     * @return void
     */
    public function mount()
    {
        $this->jenispoins = JenisPoin::where('category', CATEGORY_JENISPOIN_PENEBUSAN)
            ->orderBy('nama', 'asc')
            ->get();
        $this->allMaba = User::whereHas('kelompok')->orderBy('name')->get();
    }

    /**
     * resetAll inputan
     *
     * @return void
     */
    public function resetAll()
    {
        $this->reset('status', 'deadline', 'jenispoin', 'poin', 'accepted_at', 'taken_at', 'submited_at', 'file');
        $this->resetValidation();
    }


    /**
     * update penebusan berdasarkan statusnya
     *
     * @param  mixed $status
     * @return void
     */
    public function logicStatus($status)
    {
        $this->taken_at = now();
        $this->accepted_at = null;
        $this->submited_at = null;

        if ($status == PENEBUSAN_MENUNGGU_UPLOAD) {
            $this->submited_at = null;
        }

        if ($status == PENEBUSAN_SEDANG_DIKOREKSI) {
            $this->submited_at = now();
        }

        if ($status == PENEBUSAN_SELESAI) {
            $this->accepted_at = now();
            $this->submited_at = now();

            // jika selesai maka input data poin penebusannya
            Poin::create([
                'user_id' => $this->users,
                'jenis_poin_id' => $this->jenispoin,
                'urutan_input' => $this->accepted_at,
                'poin' => $this->poin,
                'alasan' => 'Telah menyelesaikan penugasan'
            ]);
            $this->poin_id = Poin::latest()->first()->id;
        }
    }

    /**
     * mengambil poin default ketika jenis poin diubah
     *
     * @return void
     */
    public function updatedJenispoin()
    {
        $jenispoin = JenisPoin::find($this->jenispoin);
        $this->deadline = Carbon::now()->addDay()->setTime(23, 59);
        $this->poin = $jenispoin->poin;
    }

    /**
     * submit new penebusan
     *
     * @return void
     */
public function submit()
{
    $this->validate([
        'deadline' => 'nullable',
        'status' => 'required',
        'jenispoin' => 'required',
        'users' => 'required',
        'file' => 'nullable|max:2048'
    ]);

    if (!userHasPermission(PERMISSION_ADD_PENEBUSAN))
        $this->dispatch('updated', title: 'Kamu tidak memiliki akses untuk menambah penebusan', icon: 'error', iconColor: 'red');
    else {

        $this->logicStatus($this->status);

        // siapkan file upload
        $user = User::find($this->users);
        $fileName = $user->name . '_' . $user->username . '_' . now()->format('YmdHis') . '.';

        try {
            $link = $this->file ? $this->file->storeAs('penebusan', $fileName . $this->file->extension()) : null;
            Penebusan::create([
                'user_id' => $this->users,
                'jenis_poin_id' => intval($this->jenispoin),
                'poin_id' => $this->poin_id ?? null,
                'deadline' => $this->deadline ?? null,
                'status' => $this->status,
                'link' => $link,
                'accepted_at' => $this->accepted_at,
                'submited_at' => $this->submited_at,
                'taken_at' => $this->taken_at,
            ]);

            $this->resetAll();
            $this->dispatch('updated', title: 'Penebusan berhasil ditambahkan', icon: 'success', iconColor: 'green');
            $this->dispatch('reloadTablePenebusanAdmin');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $this->dispatch('updated', title: 'Penebusan gagal ditambahkan', icon: 'error', iconColor: 'red');
        }
    }
}


    public function render()
    {
        return view('admin.tibum.penebusan.add');
    }
}
