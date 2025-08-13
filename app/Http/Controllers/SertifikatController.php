<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class SertifikatController extends Controller
{
    private $color, $font_bold, $font_medium;

    public function __construct()
    {
        $this->color = '#000';
        $this->font_bold = public_path('nunito_bold.TTF');
        $this->font_medium = public_path('nunito_medium.TTF');
    }

    /**
     * cek apakah user memiliki sertifikat atau tidak dan apakah bisa diakses atau tidak
     *
     * @param  mixed $id
     * @return void
     */
    public function index($id = null)
    {
        if (!$id) $user = auth()->user();
        else $user = User::find($id);

        // cek apakah user yang mau dilihat sertifikatnya maba atau bukan, status kelulusan sudah ada dan nimb sudah ada
        if (!$user->is_maba || !$user->status_kelulusan || !$user->nimb)
            return redirect()->back();

        // cek jika yang mau ngelihat itu maba, pastikan dia hanya liat punyanya aja dan sudah melebihi waktu canAksesNilai
        if (auth()->user()->is_maba) {
            if (auth()->user()->id != $user->id || !canAksesNilai())
                return redirect()->back();
            else {
            }
        } else {
            // jika panitia pastikan hanya panitia yang memiliki akses update nilai dan kakak pendampingnya saja
            if (!canInputNilai($user))
                return redirect()->back();
        }

        if ($user->status_kelulusan == STATUS_LULUS_PKKMB_PKBN || $user->status_kelulusan == STATUS_LULUS_PKKMB) {
            if (!$user->nomor_surat) {
                DB::transaction(function () use ($user) {
                    $counterRow = DB::table('nomor_surat_counter')->lockForUpdate()->first();

                    if (!$counterRow) {
                        $nomorSurat = 50;
                        DB::table('nomor_surat_counter')->insert([
                            'counter' => $nomorSurat,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    } else {
                        $nomorSurat = $counterRow->counter + 1;
                        DB::table('nomor_surat_counter')->update(['counter' => $nomorSurat]);
                    }

                    $nomorSuratFormatted = sprintf('%03d/A.004/PKKMB-PKBN/IX/2024', $nomorSurat);

                    $user->nomor_surat = $nomorSuratFormatted;
                    $user->save();
                });
            }

            // Gunakan nomor surat yang sudah tersimpan
            $nomorSuratFull = $user->nomor_surat;
        } else {
            $nomorSuratFull = null;
        }

        return view('home.sertifikat', [
            'imgDepan' => $this->imageDepan($user, $nomorSuratFull),
            'imgBelakang' => $this->imageBelakang($user),
            'nimb' => $user->nimb,
            'filename' => 'Sertifikat Kelulusan PKKMB'
        ]);
    }

    private function getUkuranFont($name)
    {
        if (strlen($name) > 20) {
            $ukuranFont = 90;
        } else {
            $ukuranFont = 100;
        }
        return $ukuranFont;
    }

    /**
     * sertifikat halaman kedua
     *
     * @param  mixed $user
     * @return void
     */
    private function imageDepan($user, $nomorSurat)
    {
        if ($user->status_kelulusan == STATUS_LULUS_PKKMB_PKBN || $user->status_kelulusan == STATUS_LULUS_PKKMB)
            $imgDepan = Image::make('img/sertif/2024/lulus_kosong.png');

        $ukFont = $this->getUkuranFont($user->name);
        $imgDepan->text(strtoupper($user->name), 1870, 1089.2, function ($font) use ($ukFont) {
            $font->file($this->font_bold);
            $font->size($ukFont);
            $font->color($this->color);
            $font->align('center');
            $font->valign('center');
        });

        // Tampilkan nomor surat di sertifikat jika ada
        if ($nomorSurat) {
            $imgDepan->text($nomorSurat, 1963, 497, function ($font) {
                $font->file($this->font_bold);
                $font->size(50);
                $font->color($this->color);
                $font->align('center');
                $font->valign('center');
            });
        }

        return (string) $imgDepan->encode('data-url');
    }

    /**
     * getIndikatorKoordinat
     *
     * @param  mixed $indikator
     * @return void
     */
    private function getIndikatorKoordinat($indikator)
    {
        $y = 0;

        if ($indikator == 'Wawasan 4 Pilar Kebangsaan') $y = 620.8;
        else if ($indikator == 'Etika dan Kedisiplinan')  $y = 742.2;
        else if ($indikator == 'Kepemimpinan dan Kerjasama') $y = 865.9;
        else if ($indikator == 'Keterampilan dan Ketelitian') $y = 994.2;
        else if ($indikator == 'Kreativitas') $y = 1113.7;
        else if ($indikator == 'Kemampuan Berpikir Kritis dan Wawasan Literasi') $y = 1289.8;
        else if ($indikator == 'Wawasan Politeknik Statistika STIS-BPS') $y = 1511.1;
        else if ($indikator == 'IPK') $y = 1673.1;

        return ['x_grade' => 2311.6, 'x_nilai' => 2863.7, 'y' => $y];
    }

    /**
     * sertifikat halaman 2
     *
     * @param  mixed $user
     * @return void
     */
    private function imageBelakang($user)
    {

        // Sertif Belakang
        $imgBelakang = Image::make('img/sertif/2024/ipk.png');

        // nama
        $imgBelakang->text($user->name, 1048.3, 332, function ($font) {
            $font->file($this->font_bold);
            $font->size(50);
            $font->color($this->color);
            $font->align('left');
            $font->valign('center');
        });

        //NIMB
        $imgBelakang->text($user->nimb, 1048.3, 410.7, function ($font) {
            $font->file($this->font_bold);
            $font->size(50);
            $font->color($this->color);
            $font->align('left');
            $font->valign('center');
        });

        // nilai per indikator
        $nilais = $user->getNilai()->toArray();
        foreach ($nilais as $nilai) {
            $koordinat = $this->getIndikatorKoordinat($nilai['nama']);

            $imgBelakang->text(getGrade($nilai['nilai']), $koordinat['x_grade'], $koordinat['y'], function ($font) {
                $font->file($this->font_medium);
                $font->size(55);
                $font->color($this->color);
                $font->align('center');
                $font->valign('center');
            });

            $nilaiHuruf = getBobotNilai($nilai['nilai']) * $nilai['sks'];
            $roundedNilai = number_format($nilaiHuruf, 2, '.', '');
            $imgBelakang->text($roundedNilai, $koordinat['x_nilai'], $koordinat['y'], function ($font) {
                $font->file($this->font_medium);
                $font->size(55);
                $font->color($this->color);
                $font->align('center');
                $font->valign('center');
            });
        }

        //IPK
        $ipk = number_format($user->getIp(), 2, '.', '');
        $koordinat = $this->getIndikatorKoordinat('IPK');
        $imgBelakang->text($ipk, $koordinat['x_nilai'], $koordinat['y'], function ($font) {
            $font->file($this->font_medium);
            $font->size(55);
            $font->color($this->color);
            $font->align('center');
            $font->valign('center');
        });

        // Sakit
        $sakit = 0;
        if (DB::table('jenis_poin_user')->where('user_id', $user->id)->where('jenis_poin_id', 58)->exists())
            $sakit += 1;

        $imgBelakang->text($sakit, 1573.4, 1966.2, function ($font) {
            $font->file($this->font_medium);
            $font->size(55);
            $font->color($this->color);
            $font->align('center');
            $font->valign('center');
        });

        // Izin
        $izin = 0;
        if (DB::table('jenis_poin_user')->where('user_id', $user->id)->where('jenis_poin_id', 58)->exists())
            $izin += 1;

        $imgBelakang->text($izin, 1573.4, 2096.5, function ($font) {
            $font->file($this->font_medium);
            $font->size(55);
            $font->color($this->color);
            $font->align('center');
            $font->valign('center');
        });

        // Tanpa Keterangan
        $tanpaKeterangan = 0;
        if (DB::table('jenis_poin_user')->where('user_id', $user->id)->where('jenis_poin_id', 56)->exists())
            $tanpaKeterangan += 1;

        $imgBelakang->text($tanpaKeterangan, 1573.4, 2219.7, function ($font) {
            $font->file($this->font_medium);
            $font->size(55);
            $font->color($this->color);
            $font->align('center');
            $font->valign('center');
        });


        // Persentase Kehadiran PKBN
        $persentaseHadirPKBN = 100;
        //if ($user->nimb == '17.13' || $user->nimb == '11.13')
        //    $persentaseHadirPKBN = 0;

        // $imgBelakang->text($persentaseHadirPKBN, 1573.4, 1893.4, function ($font) {
        //     $font->file($this->font_medium);
        //     $font->size(55);
        //     $font->color($this->color);
        //     $font->align('center');
        //     $font->valign('center');
        // });

        // Persentase Kehadiran MP2K
        $event = Event::get();
        $hadir = 0;
        foreach ($event as $e) {
            if (DB::table('events_user')
                ->where('event_id', $e->id)
                ->where('user_id', $user->id)
                ->exists()
            ) {
                $hadir += 1;
            }
        }
        $persentaseHadirMP2K = $hadir / 4 * 100;

        $imgBelakang->text($persentaseHadirMP2K, 1573.4, 2344.9, function ($font) {
            $font->file($this->font_medium);
            $font->size(55);
            $font->color($this->color);
            $font->align('center');
            $font->valign('center');
        });


        // Poin
        $poin = $user->getKalkulasiPoin()['akumulasi'];
        $imgBelakang->text($poin, 3072.2, 2387.7, function ($font) {
            $font->file($this->font_bold);
            $font->size(60);
            $font->color($this->color);
            $font->align('left');
            $font->valign('center');
        });

        return (string) $imgBelakang->encode('data-url');
    }
}
