<?php

namespace App\Livewire\Admin\Tibum\Jenispoin;

use App\Models\Poin\JenisPoin;
use Livewire\WithPagination;
use Livewire\Component;
use Livewire\Attributes\On;

class Table extends Component
{
    use WithPagination;

    public $poinSelected;
    public $nama, $detail, $category, $poin, $is_bintang, $alasan_template, $categorySelected = -1;
    public $openedit = false;
    public $search;
    public $jenispoinToShow;
    public $showModalDetail = false;

    public function resetAll()
    {
        $this->reset('nama', 'category', 'poin', 'detail', 'search', 'openedit', 'poinSelected', 'is_bintang', 'alasan_template');
    }

    /**
     * Untuk memunculkan modal edit dan memilih pengumuman yang akan diedit
     *
     * @param mixed $p
     * @return void
     */
    public function edit(JenisPoin $poin)
    {
        $this->poinSelected = $poin;
        $this->nama = $poin->nama;
        $this->category = $poin->category;
        $this->detail = $poin->detail;
        $this->poin = $poin->poin;
        $this->is_bintang = $poin->is_bintang;
        $this->alasan_template = $poin->alasan_template;
        $this->openedit = true;
    }

    /**
     * melakukan update pada pengumuman
     *
     * @return void
     */
    public function update()
    {
        $this->validate([
            'nama' => 'required',
            'category' => 'required',
            'poin' => 'nullable|numeric',
        ]);

        if (!userHasPermission(PERMISSION_UPDATE_JENISPOIN)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk update jenis poin', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            if (!$this->poinSelected) {
                $this->dispatch('updated', 
                    title: 'Jenis poin tidak ditemukan', 
                    icon: 'error', 
                    iconColor: 'red'
                );
                return;
            }

            $this->poinSelected->update([
                'nama' => $this->nama,
                'category' => $this->category,
                'detail' => $this->detail,
                'poin' => $this->poin ?? 0,
                'is_bintang' => $this->is_bintang,
                'alasan_template' => $this->alasan_template
            ]);

            $this->resetAll();

            $this->dispatch('updated', 
                title: 'Berhasil mengedit jenis poin', 
                icon: 'success', 
                iconColor: 'green'
            );
            
        } catch (\Throwable $th) {
            \Log::error('Error updating jenis poin: ' . $th->getMessage());
            
            $this->dispatch('updated', 
                title: 'Gagal mengedit jenis poin', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    /**
     * untuk memunculkan popup detail pengumiman
     *
     * @param mixed $id
     * @return void
     */
    public function show(JenisPoin $poin)
    {
        $this->jenispoinToShow = $poin;
        $this->showModalDetail = true;
    }

    /**
     * hapus pengumuman
     *
     * @param mixed $id
     * @return void
     */
    public function destroy(JenisPoin $jenisPoin)
    {
        if (!userHasPermission(PERMISSION_DELETE_JENISPOIN)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk menghapus jenis poin', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $jenisPoin->delete();
            
            $this->dispatch('updated', 
                title: 'Berhasil menghapus jenis poin', 
                icon: 'success', 
                iconColor: 'green'
            );
            
        } catch (\Throwable $th) {
            \Log::error('Error deleting jenis poin: ' . $th->getMessage());
            
            $this->dispatch('updated', 
                title: "Gagal menghapus jenis poin", 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    #[On('reloadTableJenisPoin')]
    public function refresh()
    {
        // Magic method $refresh() sekarang menjadi method explicit
    }

    /**
     * Lifecycle hook untuk reset pagination ketika pencarian atau kategori berubah
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategorySelected()
    {
        $this->resetPage();
    }

    /**
     * getJenisPoin berdasarkan filter yang dipilih
     *
     * @param  mixed $search
     * @return void
     */
    private function getJenisPoin($search)
    {
        $query = JenisPoin::where('nama', 'like', $search)
            ->orderBy('category', 'desc')
            ->orderBy('updated_at', 'desc');

        if ($this->categorySelected != -1)
            $query->where('category', $this->categorySelected);

        return $query->paginate(NUMBER_OF_PAGINATION);
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        return view('admin.tibum.jenispoin.table', ['jenispoin' => $this->getJenisPoin($search)]);
    }
}
