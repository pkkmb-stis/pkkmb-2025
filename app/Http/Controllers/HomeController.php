<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\User;
use App\Models\Event;
use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Formulir;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\FormulirVerification;
use App\Services\GoogleSheetService;


class HomeController extends Controller
{
    protected $googleSheetService;

    public function __construct(GoogleSheetService $googleSheetService)
    {
        $this->googleSheetService = $googleSheetService;
    }
    /**
     * index, landing page utama
     *
     * @return void
     */
    public function index()
    {
        $berita = Berita::where('published_datetime', '<=', DB::raw(rawSQLDateTime()))->get();
        $video = Gallery::video()
            ->where('urutan', '!=', null)
            ->limit(3)
            ->orderby('urutan', 'asc')
            ->get();

        return view('home.index', ['berita' => $berita, 'video' => $video]);
    }

    /**
     * timeline
     *
     * @return void
     */
    public function timeline()
    {
        $timeline = Event::timeline()->get();
        $tomorrow = Carbon::tomorrow();
        $rincianKegiatan = getRincianKegiatan();
        return view('home.timeline', ['timeline' => $timeline, 'rincianKegiatan' => $rincianKegiatan, 'tomorrow' => $tomorrow]);
    }

    /**
     * galeri foto
     *
     * @return void
     */
    public function galeri()
    {
        // Ambil event yang ada foto
        $timelines = Gallery::foto()->orderBy('event_id', 'asc')->get()
            ->map(function ($photo) {
                return $photo->event;
            })->unique();

        // Kirimkan timeline ke view, foto akan diambil sesuai dengan timeline-nya
        return view('home.galeri', ['timelines' => $timelines]);
    }

    /**
     * tentang page
     *
     * @return void
     */
    public function tentang()
    {
        return view('home.tentang');
    }

    /**
     * FAQ page
     *
     * @return void
     */
    public function FAQ()
    {
        $faqs = Faq::all();
        return view('home.faq', ['faqs' => $faqs]);
    }

    /**
     * video page
     *
     * @return void
     */
    public function video()
    {
        $videos = Gallery::video()
            ->orderBy('urutan', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('home.video', ['videos' => $videos]);
    }

    /**
     * Ambil form yg belum diisi
     * @param mixed $user
     * @return array
     */
    public function getUnfilledFormulirs(User $user)
    {
        $visibleFormulirs = Formulir::where('is_visible', true)->get();
        $unfilledFormulirs = [];

        foreach ($visibleFormulirs as $formulir) {
            $userNimb = $user->nimb;

            // Mengecek apakah user telah mengisi formulir tertentu
            $userFormulirExists = FormulirVerification::where('nimb', $userNimb)
                ->where('formulir_id', $formulir->id)
                ->exists();

            if (!$userFormulirExists) {
                $unfilledFormulirs[] = $formulir;
            }
        }
        return $unfilledFormulirs;
    }

    /**
     * dashboard sisi user
     *
     * @return void
     */
    public function dashboard()
    {
        $user = auth()->user();

        if ($user->is_maba) {
            $unfilledFormulirs = $this->getUnfilledFormulirs($user);
            if (!empty($unfilledFormulirs)) {
                return view('home.reminderFormulir', [
                    'unfilledFormulirs' => $unfilledFormulirs
                ]);
            }
        }

        // Jika semua formulir sudah diisi atau user bukan mahasiswa baru, tampilkan dashboard
        return view('home.dashboard', [
            'user' => $user->load('kelompok'),
        ]);
    }

    /**
     * profil, halaman profil
     *
     * @param  mixed $request
     * @return void
     */
    public function profil(Request $request)
    {
        $data['menu'] = $request->query('menu') ?? 'edit';

        $user = auth()->user();
        $data['unfilledFormulirs'] = $this->getUnfilledFormulirs($user);

        // Kalau maba ambil nilainya
        if ($user->is_maba) {
            $data['indikator'] = $user->getNilai();
            $data['ip'] = $user->getIp();
        }

        if ($user->kelompok_id) {
            $kelompok = Kelompok::find($user->kelompok_id);
            if ($kelompok) {
                $lapkUser = User::find($kelompok->lapk_user_id);
                $data['nowa'] = $lapkUser ? $lapkUser->nowa : null;
            } else {
                $data['nowa'] = null;
            }
        } else {
            $data['nowa'] = null;
        }

        return view('home.profil', $data);
    }


    /**
     * ppo, halaman panitia ppo
     *
     * @return void
     */
    // public function ppo()
    // {
    //     return view('home.ppo', getPanitia());
    // }

    /**
     * dosen, halaman panitia dosen
     *
     * @return void
     */
    // public function dosen()
    // {
    //     return view('home.dosen', getDosen());
    // }

    /**
     * panitia, halaman panitia
     *
     * @return void
     */
    public function panitia()
    {
        // Ambil data dari kedua sumber
        $ppoData = getPanitia();
        $dosenData = getDosen();

        // Gabungkan kedua array data menjadi satu
        $allData = array_merge($ppoData, $dosenData);

        // Kirim semua data yang sudah digabung ke view
        return view('home.panitia', $allData);
    }
}
