<?php

namespace App\Http\Livewire\Admin\Maba\Poin;

use App\Models\Poin\JenisPoin;
use App\Models\Poin\Poin;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;

    public $allMaba, $allPanitia;
    public $jenispoins;
    public $users, $alasan, $jenispoin, $poin, $urutan_input, $is_bintang, $image;
    public $addmodal = false;
    public $jenisPoinSelected;

    public $rand;

    public function resetForm()
    {
        $this->rand++;
    }

    public function resetAll($closeModal = true)
    {
        $this->reset('alasan', 'jenispoin', 'poin', 'urutan_input', 'users','image');
        $this->resetValidation();
        if ($closeModal)
            $this->reset('addmodal');
    }

    public function mount()
    {
        $this->jenispoins = JenisPoin::whereIn('category', [CATEGORY_JENISPOIN_PENGHARGAAN, CATEGORY_JENISPOIN_PELANGGARAN, CATEGORY_JENISPOIN_PENEBUSAN])
            ->orderBy('category', 'asc')
            ->orderBy('nama', 'asc')
            ->get();

        $this->allMaba = User::whereHas('kelompok')->with('kelompok')->get();
        $this->allPanitia = User::role(ROLE_PANITIA)->get();
    }

    public function updatedJenispoin($jenispoin)
    {
        $jenispoinInt = intval($jenispoin);

        if ($jenispoinInt > 0) {
            $this->jenisPoinSelected = JenisPoin::find($jenispoinInt % 1000);

            if ($this->jenisPoinSelected) {
                $this->poin = $this->jenisPoinSelected->poin;
                $this->alasan = $this->jenisPoinSelected->alasan_template;
            } else {
                $this->poin = 0;
                $this->alasan = '';
            }
        } else {
            $this->poin = 0;
            $this->alasan = '';
        }
    }

    public function submit()
    {

        if (!userHasPermission(PERMISSION_ADD_POIN))
            return $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menambah poin', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            //* Validasi
            if ($this->jenisPoinSelected != null && $this->jenisPoinSelected->category == CATEGORY_JENISPOIN_PELANGGARAN) {
                $this->validate([
                    'poin' => 'required|numeric',
                    'alasan' => 'max:160',
                    'jenispoin' => 'required|numeric',
                    'users' => 'required|array',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
                if (isset($this->image)) {
                    $filename = sha1(uniqid(mt_rand(), true)) . '.' . $this->image->getClientOriginalExtension();
                    $this->image->storeAs('images/bukti-poin', $filename, 'public');
                } else {
                    $filename = null;
                }
            } else {
                $this->validate([
                    'poin' => 'required|numeric',
                    'alasan' => 'max:160',
                    'jenispoin' => 'required|numeric',
                    'users' => 'required|array',
                ]);
                $filename = null;
            }

            //* Simpan
            try {

                $data = [
                    'urutan_input' => $this->urutan_input ?? now(),
                    'poin' => $this->poin,
                    'alasan' => $this->alasan,
                    'filename' => $filename,

                    // 'is_bintang' => $this->jenisPoinSelected->is_bintang,
                ];

                //filter user yang sudah melakukan pelanggaran tidak dapat poin penghargaan
                if($this->jenisPoinSelected->category == CATEGORY_JENISPOIN_PENGHARGAAN){
                    $this->users = Poin::filterUsers($this->users,$this->jenisPoinSelected,$data);
                }

                DB::beginTransaction();
                foreach ($this->users as $user) {
                    Poin::insertPoin($user, $this->jenisPoinSelected, $data);
                }
                DB::commit();

                $this->dispatchBrowserEvent('updated', [
                    'title' => 'Poin berhasil ditambahkan untuk ' . count($this->users) . ' user',
                    'icon' => 'success',
                    'iconColor' => 'green'
                ]);

                $this->emit('reloadTableInputPoin');
            } catch (\Throwable $th) {
                DB::rollBack();

                $this->dispatchBrowserEvent('updated', [
                    'title' => 'Gagal menambahkan poin',
                    'icon' => 'error',
                    'iconColor' => 'red'
                ]);
            }
        }

        $this->resetForm();
        $this->resetAll(false);
        $this->emit('resetSlim');
    }

    /**
     * On update status, reset deadline
     */

    public function updatedStatus()
    {
        if ($this->status != MAP_CATEGORY['penebusan_user'][2]) {
            $this->reset('deadline');
        }
    }
    /**
     * closeModal add poion
     *
     * @return void
     */
    public function closeModal()
    {
        $this->addmodal = false;
        $this->reset('alasan', 'jenispoin', 'poin');
        $this->resetValidation();
    }
    public function render()
    {
        return view('admin.maba.poin.add');
    }
}
