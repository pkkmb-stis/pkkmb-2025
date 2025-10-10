<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminta\Http\Request;
use Intervention\Image\Facades\Image;

class CoCardController extends Controller
{
    private $color, $font_medium, $font_bold, $kelompok;

    public function __construct()
    {
        $this->color = '#000000';
        $this->font_medium = public_path('Poppins-Regular.ttf');
        $this->font_bold = public_path('Poppins-Bold.ttf');
        $this->font_bold_belakang = public_path('arial_narrow_bold.ttf');
    }

    /**
     * cek apakah user memiliki co card atau tidak dan apakah bisa diakses atau tidak
     *
     * @param mixed $id
     * @return void
     */
    public function index($id = null)
    {
        if (!$id)
            $user = auth()->user();
        else
            $user = User::find($id);

        // cek apakah user yang mau dilihat co cardnya maba atau bukan dan nimb sudah ada
        if (!$user->is_maba || !$user->nimb || !$user->nama_statistik)
            return redirect('/profil')->with('error', 'Gagal Mendownload Cocard');

        return view('home.cocard', [
            'imgDepan' => $this->imageDepan($user),
            'desainDepan' => $this->desainDepan(),
            'imgBelakang' => $this->imageBelakang($user),
            'desainBelakang' => $this->desainBelakang(),
            'nimb' => $user->nimb,
            'username' => $user->username,
        ]);
    }

    /**
     * co card halaman depan
     *
     * @param mixed $user
     * @return void
     */
    private function imageDepan($user)
    {
        $imgDepan = Image::make('img/co_card/co_card_kosong.png');
        $user->load('kelompok');
        if ($user->kelompok)
            $this->kelompok = $user->kelompok->load('pendamping');
        $namaKelompok = strtoupper($this->kelompok->nama);
        //$namaMaba = strtoupper($user->name);
        $namaMaba = strtoupper($this->getShortName($user->name));
        $namaKhas = strtoupper($user->nama_statistik);

        // Background Co Card
        $imgDepan->rectangle(0, 0, 2126, 1535.4, function ($draw) {
            $draw->background($this->kelompok->warna_co_card);
        });

        // Nama Kelompok
        $imgDepan->text($namaKelompok, 1063, 340.7, function ($font) {
            $font->file($this->font_bold);
            $font->size(100);
            $font->color($this->color);
            $font->align('center');
            $font->valign('center');
        });

        // Nama Maba
        $imgDepan->text($namaMaba, 1063, 1250.5, function ($font) {
            $font->file($this->font_bold);
            $font->size(115);
            $font->color($this->color);
            $font->align('center');
            $font->valign('center');
        });

        // Nama Khas
        $imgDepan->text($namaKhas, 1063, 1378.4, function ($font) {
            $font->file($this->font_medium);
            $font->size(100);
            $font->color($this->color);
            $font->align('center');
            $font->valign('center');
        });

        return (string)$imgDepan->encode('data-url');
    }

    private function getShortName($name)
    {
        $nameArr = explode(' ', $name);
        $numberOfNames = count($nameArr);
        $shortName = '';
        if (strlen($name) > 20) {
            for ($i = 0; $i < $numberOfNames; $i++) {
                if (strlen($shortName) + strlen($nameArr[$i]) > 20) {
                    $shortName .= ' ' . $nameArr[$i][0] . '.';
                } else {
                    $shortName .= ' ' . $nameArr[$i];
                }
            }
            return $shortName;
        }
        return $name;
    }

    /**
     * desain halaman depan
     *
     * @param mixed $user
     * @return void
     */
    private function desainDepan()
    {
        $desainDepan = Image::make('img/co_card/co_card_depan.png');

        return (string)$desainDepan->encode('data-url');
    }

    /**
     * co card halaman belakang
     *
     * @param mixed $user
     * @return void
     */
    private function imageBelakang($user)
    {

        // Sertif Belakang
        $imgBelakang = Image::make('img/co_card/co_card_kosong.png');

        // Background Co Card
        $imgBelakang->rectangle(0, 0, 2126, 1535.4, function ($draw) {
            $draw->background($this->kelompok->warna_co_card);
        });

        // Kotak NIMB
        $imgBelakang->rectangle(236.4, 376.4, 1895.4, 1264.8, function ($draw) {
            $draw->background('rgb(255, 255, 255)');
        });

        // NIMB
        $imgBelakang->text($user->nimb, 1065.9, 820.6, function ($font) {
            $font->file($this->font_bold_belakang);
            $font->size(660);
            $font->color($this->color);
            $font->align('center');
            $font->valign('center');
        });

        return (string)$imgBelakang->encode('data-url');
    }

    /**
     * desain halaman belakang
     *
     * @param mixed $user
     * @return void
     */
    private function desainBelakang()
    {
        $desainBelakang = Image::make('img/co_card/co_card_belakang.png');

        return (string)$desainBelakang->encode('data-url');
    }
}

?>
