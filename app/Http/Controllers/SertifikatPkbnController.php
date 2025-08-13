<?php

namespace App\Http\Controllers;

use App\Models\User;
use Intervention\Image\Facades\Image;

class SertifikatPkbnController extends Controller
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

        return view('home.sertifikat', [
            'imgDepan' => $this->imageDepan($user),
            'imgBelakang' => $this->imageBelakang($user),
            'nimb' => $user->nimb,
            'filename' => 'Sertifikat Kelulusan PKBN'
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
    private function imageDepan($user)
    {
        if ($user->status_kelulusan == STATUS_LULUS_PKKMB_PKBN || $user->status_kelulusan == STATUS_LULUS_PKBN)
            $imgDepan = Image::make('img/sertif/2024/PKBN/lulus.png');

        $ukFont = $this->getUkuranFont($user->name);
        $imgDepan->text(strtoupper($user->name), 1870, 1089.2, function ($font) use ($ukFont) {
            $font->file($this->font_bold);
            $font->size($ukFont);
            $font->color($this->color);
            $font->align('center');
            $font->valign('center');
        });

        return (string) $imgDepan->encode('data-url');
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
        $imgBelakang = Image::make('img/sertif/2024/PKBN/materi.png');

        // nama
        $imgBelakang->text($user->name, 978.3, 487.9, function ($font) {
            $font->file($this->font_bold);
            $font->size(55);
            $font->color($this->color);
            $font->align('left');
            $font->valign('center');
        });

        //NIMB
        $imgBelakang->text($user->nimb, 978.3, 562.6, function ($font) {
            $font->file($this->font_bold);
            $font->size(55);
            $font->color($this->color);
            $font->align('left');
            $font->valign('center');
        });

        return (string) $imgBelakang->encode('data-url');
    }
}
