<?php

namespace App\Livewire\Admin\Informasi\Formulir;

use App\Models\Formulir;
use Livewire\Component;
use Livewire\Attributes\On;

class Detail extends Component
{
    public $showModalDetail = false, $canUpdate;
    public $spreadsheet_id, $nama_formulir, $is_visible, $link_form, $search_range, $nama_sheet, $formulir;

    public function mount()
    {
        $this->canUpdate = userHasPermission(PERMISSION_UPDATE_FORMULIR);
    }

    #[On('openDetailFormulir')]
    public function openDetailFormulir(Formulir $formulir)
    {
        $this->resetValidation();
        $this->formulir = $formulir;
        $this->spreadsheet_id = $formulir->spreadsheet_id;
        $this->nama_formulir = $formulir->nama_formulir;
        $this->is_visible = $formulir->is_visible;
        $this->search_range = $formulir->search_range;
        $this->link_form = $formulir->link_form;
        $this->nama_sheet = $formulir->nama_sheet;
        $this->showModalDetail = true;
    }

    public function update()
    {
        $this->validate([
            'spreadsheet_id' => 'required',
            'nama_formulir' => 'required',
            'link_form' => 'required',
            'search_range' => 'required',
            'is_visible' => 'boolean',
            'nama_sheet' => 'required|string|unique:formulir,nama_sheet,' . $this->formulir->id,
        ]);

        if (!userHasPermission(PERMISSION_UPDATE_FORMULIR)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk mengubah Formulir', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $this->formulir->update([
                'spreadsheet_id' => $this->spreadsheet_id,
                'nama_formulir' => $this->nama_formulir,
                'link_form' => $this->link_form,
                'search_range' => $this->search_range,
                'is_visible' => $this->is_visible,
                'nama_sheet' => $this->nama_sheet,
            ]);
            
            $this->dispatch('updated', 
                title: 'Berhasil mengubah Formulir', 
                icon: 'success', 
                iconColor: 'green'
            );
            
            $this->dispatch('refreshAdminFormulir');
            $this->showModalDetail = false;
            
        } catch (\Throwable $th) {
            \Log::error('Update Formulir Error: ' . $th->getMessage(), [
                'formulir_id' => $this->formulir->id,
                'user_id' => auth()->id()
            ]);
            
            $this->dispatch('updated', 
                title: 'Gagal mengubah Formulir', 
                icon: 'error', 
                iconColor: 'red'
            );
        }
    }

    public function render()
    {
        return view('admin.informasi.formulir.detail');
    }
}
