<?php

namespace App\Http\Controllers;

use App\Models\Formulir;
use Illuminate\Http\Request;
use App\Models\FormulirVerification;

class GoogleSheetsWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $expectedToken = env('GOOGLE_SHEETS_WEBHOOK_TOKEN');

        $token = $request->input('token');

        if ($token !== $expectedToken) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }
        $data = $request->all();

        if (isset($data['nim']) && isset($data['sheet_name'])) {
            $nim = $this->formatNim($data['nim']);
            $sheetName = $data['sheet_name'];

            $formulir = Formulir::where('nama_sheet', $sheetName)->first();

            if ($formulir) {
                $formulirId = $formulir->id;

                $exists = FormulirVerification::where('nimb', $nim)
                    ->where('formulir_id', $formulirId)
                    ->exists();

                if (!$exists) {
                    FormulirVerification::create([
                        'nimb' => $nim,
                        'formulir_id' => $formulirId,
                    ]);
                    return response()->json(['status' => 'success'], 200);
                } else {
                    return response()->json(['status' => 'exists', 'message' => 'Data already exists'], 200);
                }
            } else {
                return response()->json(['status' => 'error', 'message' => 'Formulir not found'], 404);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid data'], 400);
    }

    private function formatNim($nim)
    {
        // Split NIMB berdasarkan titik
        $parts = explode('.', $nim);

        // Format setiap bagian
        if (count($parts) == 2) {
            $part1 = str_pad($parts[0], 2, '0', STR_PAD_LEFT);
            $part2 = str_pad($parts[1], 2, '0', STR_PAD_RIGHT);

            return $part1 . '.' . $part2;
        }

        return $nim; // Jika format tidak sesuai, kembalikan nilai asli
    }
}
