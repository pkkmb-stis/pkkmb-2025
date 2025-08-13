<?php

namespace App\Http\Livewire\Admin\Informasi\Formulir\Detail;

use Livewire\Component;
use App\Models\Formulir;
use Illuminate\Support\Facades\Log;
use App\Models\FormulirVerification;
use App\Services\GoogleSheetService;

class DetailFormulir extends Component
{
    public $formulir;

    protected $listeners = ['syncData' => 'handleSyncData'];

    public function mount($formulir)
    {
        $this->formulir = $formulir;
    }

    public function handleSyncData(GoogleSheetService $googleSheetService)
    {
        $nimbData = $googleSheetService->readSheet($this->formulir->search_range, $this->formulir->spreadsheet_id);

        try {
            if (!empty($nimbData)) {
                foreach ($nimbData as $row) {
                    $nimb = trim($row[0]);
                    $nimb = $this->formatNim($nimb);

                    $exists = FormulirVerification::where('nimb', $nimb)
                        ->where('formulir_id', $this->formulir->id)
                        ->exists();

                    if (!$exists) {
                        FormulirVerification::create([
                            'nimb' => $nimb,
                            'formulir_id' => $this->formulir->id,
                        ]);
                    }
                }
            }
            $this->emit('refreshDetailFormulir');
            $this->dispatchBrowserEvent('updated', ['title' => "Data berhasil disinkronkan dari Google Sheets", 'icon' => 'success', 'iconColor' => 'green']);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('updated', ['title' => "Data tidak berhasil disinkronkan", 'icon' => 'error', 'iconColor' => 'red']);
        }
    }

    private function formatNim($nim)
    {
        // Split NIMB berdasarkan titik
        $parts = explode('.', $nim);

        // Pastikan ada dua bagian
        if (count($parts) == 2) {
            // Format setiap bagian
            $part1 = str_pad($parts[0], 2, '0', STR_PAD_LEFT); // Bagian pertama dengan dua digit
            $part2 = str_pad($parts[1], 2, '0', STR_PAD_RIGHT); // Bagian kedua dengan dua digit, diisi nol jika perlu

            return $part1 . '.' . $part2;
        }

        return $nim; // Jika format tidak sesuai, kembalikan nilai asli
    }


    public function render()
    {
        return view('admin.informasi.formulir.detail.detail-formulir', [
            'formulir' => $this->formulir
        ]);
    }
}
