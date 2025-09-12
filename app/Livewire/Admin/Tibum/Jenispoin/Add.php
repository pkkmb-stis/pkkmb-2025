<?php

namespace App\Livewire\Admin\Tibum\Jenispoin;

use App\Models\Poin\JenisPoin;
use Livewire\Component;

class Add extends Component
{
    public $nama, $detail, $category, $poin, $alasan_template, $type;
    public $is_bintang = 0;

    /**
     * closeModal add pengumuman
     *
     * @return void
     */
    public function closeModal()
    {
        $this->reset('nama', 'category', 'poin', 'detail', 'type', 'is_bintang', 'alasan_template');
        $this->resetValidation();
    }

    /**
     * updatedType ketika pilihannya penebusan
     *
     * @return void
     */
    public function updatedType()
    {
        if ($this->type == "1") $this->poin = POIN_PENEBUSAN_RINGAN;
        else if ($this->type == "2") $this->poin = POIN_PENEBUSAN_SEDANG;
        else if ($this->type == "3") $this->poin = POIN_PENEBUSAN_BERAT;
    }

    /**
     * add new pengumuman
     *
     * @return void
     */
    public function submit()
    {
        $type = ($this->category == CATEGORY_JENISPOIN_PENEBUSAN) ? 'required' : 'nullable';
        
        $this->validate([
            'nama' => 'required',
            'type' => $type,
            'category' => 'required',
        ]);

        if (!userHasPermission(PERMISSION_ADD_JENISPOIN)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk menambah jenis poin', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            JenisPoin::create([
                'nama' => $this->nama,
                'category' => $this->category,
                'type' => $this->type ?? null,
                'poin' => $this->poin ?? 0,
                'detail' => $this->detail,
                'is_bintang' => $this->is_bintang,
                'alasan_template' => $this->alasan_template
            ]);

            $this->closeModal();

            $this->dispatch('updated', 
                title: 'Berhasil menambahkan jenis poin', 
                icon: 'success', 
                iconColor: 'green'
            );

            $this->dispatch('reloadTableJenisPoin');
            
        } catch (\Exception $e) {
            // Log error untuk debugging, jangan gunakan dd()
            \Log::error('Error creating jenis poin: ' . $e->getMessage());
            
            $this->dispatch('updated', 
                title: "Gagal menambah jenis poin", 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }


    public function render()
    {
        return view('admin.tibum.jenispoin.add');
    }
}
