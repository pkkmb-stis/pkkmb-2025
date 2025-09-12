<?php

namespace App\Livewire\Home\Profil;

use App\Models\User;
use App\Models\Provinsi;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;

    public $user;
    public $provinsi;
    public $provinsiUser;
    public $kabupaten = [];
    public $kabupatenActive = false;

    protected $rules = [
        'user.prodi' => '',
        'user.jenis_kelamin' => '',
        'user.kabkot_id' => '',
        'user.alamat' => '',
        'user.nowa' => '',
        'user.himada' => '',
    ];


    /**
     * mount, ambil data yang diperlukan
     *
     * @return void
     */
    public function mount()
    {

        $this->user = auth()->user();
        $this->kabupatenActive = $this->user->kabkot_id ? true : false;
        $this->provinsi = Provinsi::all();

        // kalau ada kabupatennya maka ambil data provinsinya
        if ($this->user->kabkot_id) {
            $this->provinsiUser = $this->user->kabupaten->provinsi->prov_id;
            $this->updatedProvinsiUser();
        }
    }

    /**
     * ambil data kabupaten ketika pilihan provinsi berubah
     *
     * @return void
     */
    public function updatedProvinsiUser()
    {
        $this->kabupaten = Provinsi::find($this->provinsiUser)->kabkot;
        $this->kabupatenActive = true;
    }

    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        // validasi no wa minimal 10 maksimal 15
        if ($this->user->nowa)
            $this->validate([
                'user.nowa' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15'
            ]);

        // kalau provinsinya ada maka kabuoatennya harus dipilih dulu
        if ($this->provinsiUser)
            $this->validate([
                'user.kabkot_id' => 'required'
            ]);

        try {
            $this->user->save();
            $this->dispatch('updated', 
                title: 'Perubahan berhasil disimpan', 
                icon: 'success', 
                iconColor: 'green'
            );
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $this->dispatch('updated', 
                title: 'Perubahan gagal disimpan', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }


    public function render()
    {
        return view('home.profil.edit');
    }
}
