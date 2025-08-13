<?php

namespace App\Http\Livewire\Admin\Informasi\Formulir;

use App\Models\Formulir;
use Livewire\Component;

class Add extends Component
{
    public $showModalAdd = false;
    public $spreadsheet_id, $nama_formulir, $is_visible = true, $link_form, $search_range, $nama_sheet;

    public function resetAll()
    {
        $this->reset('spreadsheet_id', 'nama_formulir', 'link_form', 'search_range', 'is_visible', 'nama_sheet', 'showModalAdd');
    }

    public function submit()
    {
        $this->validate([
            'spreadsheet_id' => 'required',
            'nama_formulir' => 'required',
            'link_form' => 'required',
            'search_range' => 'required',
            'is_visible' => 'boolean',
            'nama_sheet' => 'required|string|unique:formulir,nama_sheet',
        ]);

        if (!userHasPermission(PERMISSION_ADD_FORMULIR))
            $this->dispatchBrowserEvent('updated', ['title' => 'Kamu tidak memiliki akses untuk menambah Formulir', 'icon' => 'error', 'iconColor' => 'red']);
        else {
            try {
                Formulir::create([
                    'spreadsheet_id' => $this->spreadsheet_id,
                    'nama_formulir' => $this->nama_formulir,
                    'link_form' => $this->link_form,
                    'search_range' => $this->search_range,
                    'is_visible' => $this->is_visible,
                    'nama_sheet' => $this->nama_sheet,
                ]);
                $this->dispatchBrowserEvent('updated', ['title' => 'Berhasil menambah Formulir', 'icon' => 'success', 'iconColor' => 'green']);
                $this->emit('refreshAdminFormulir');
            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('updated', ['title' => 'Gagal menambahkan Formulir', 'icon' => 'error', 'iconColor' => 'red']);
            }

            $this->resetAll();
        }
    }

    public function render()
    {
        return view('admin.informasi.formulir.add');
    }
}
