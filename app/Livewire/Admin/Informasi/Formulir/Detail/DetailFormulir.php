<?php

namespace App\Livewire\Admin\Informasi\Formulir\Detail;

use Livewire\Component;
use App\Models\Formulir;
use Illuminate\Support\Facades\Log;
use App\Models\FormulirVerification;
use App\Services\GoogleSheetService;
use Livewire\Attributes\On;

class DetailFormulir extends Component
{
    public $formulir;

    public function mount($formulir)
    {
        $this->formulir = $formulir;
    }

    #[On('syncData')]
    public function handleSyncData(GoogleSheetService $googleSheetService)
    {
        if (!userHasPermission(PERMISSION_SYNC_FORMULIR)) {
            $this->dispatch('updated', 
                title: 'Kamu tidak memiliki akses untuk sinkronisasi data', 
                icon: 'error', 
                iconColor: 'red'
            );
            return;
        }

        try {
            $nimbData = $googleSheetService->readSheet(
                $this->formulir->search_range, 
                $this->formulir->spreadsheet_id
            );

            if (empty($nimbData)) {
                $this->dispatch('updated', 
                    title: 'Tidak ada data ditemukan di Google Sheets', 
                    icon: 'warning', 
                    iconColor: 'yellow'
                );
                return;
            }

            $syncedCount = 0;
            $skippedCount = 0;

            foreach ($nimbData as $row) {
                $nimb = trim($row[0]);
                $nimb = $this->formatNim($nimb);

                if (empty($nimb)) {
                    continue; // Skip empty NIMB
                }

                $exists = FormulirVerification::where('nimb', $nimb)
                    ->where('formulir_id', $this->formulir->id)
                    ->exists();

                if (!$exists) {
                    FormulirVerification::create([
                        'nimb' => $nimb,
                        'formulir_id' => $this->formulir->id,
                    ]);
                    $syncedCount++;
                } else {
                    $skippedCount++;
                }
            }

            $this->dispatch('refreshDetailFormulir');
            
            $this->dispatch('updated', 
                title: "Data berhasil disinkronkan. {$syncedCount} data baru, {$skippedCount} data sudah ada.", 
                icon: 'success', 
                iconColor: 'green'
            );
            
        } catch (\Throwable $th) {
            \Log::error('Sync Data Error: ' . $th->getMessage(), [
                'formulir_id' => $this->formulir->id,
                'spreadsheet_id' => $this->formulir->spreadsheet_id,
                'user_id' => auth()->id()
            ]);
            
            $this->dispatch('updated', 
                title: 'Data tidak berhasil disinkronkan: ' . $th->getMessage(), 
                icon: 'error', 
                iconColor: 'red'
            );
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
