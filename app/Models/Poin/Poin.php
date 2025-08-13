<?php

namespace App\Models\Poin;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Validation\Rules\Unique;

class Poin extends Pivot
{
    use HasFactory;

    protected $table = "jenis_poin_user";
    protected $guarded = [];
    protected $casts = [
        'urutan_input' => 'datetime:Y-m-d H:i:s'
    ];
    public $timestamps = true;

    /**
     * one to one dengan user
     *
     * @return void
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * one to one dengan jenis poin
     *
     * @return void
     */
    public function jenispoin()
    {
        return $this->hasOne(JenisPoin::class, 'id', 'jenis_poin_id');
    }

    /**
     * Filter users based on their violations before granting rewards.
     *
     * @param  array $users
     * @param  JenisPoin $jenispoin
     * @param  array $data
     * @return array
     */
    public static function filterUsers(array $users, JenisPoin $jenispoin, array $data): array
    {
        $jenisPoinId = $jenispoin->id;
        $jenisPelanggaran = [];

        switch ($jenisPoinId) {
            case JENISPOIN_ATRIBUT_LENGKAP:
                $jenisPelanggaran = [
                    JENISPOIN_ATRIBUT_TIDAK_LENGKAP,
                    JENISPOIN_PAKAIAN_KUCEL,
                    JENISPOIN_NODA_TAMPAK,
                    JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN,
                    JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN_GELANG,
                    JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN_CINCIN,
                    JENISPOIN_ATRIBUT_TIDAK_DIJELASKAN_KALUNG
                ];
                break;

            case JENISPOIN_TEPAT_WAKTU:
                $jenisPelanggaran = [
                    JENISPOIN_MABA_LAMBAT_0_15,
                    JENISPOIN_MABA_LAMBAT_16_30,
                    JENISPOIN_MABA_LAMBAT_31
                ];
                break;

            case JENISPOIN_ATRIBUT_PKBN_LENGKAP:
                $jenisPelanggaran = [JENISPOIN_ATRIBUT_TIDAK_LENGKAP];
                break;

            case JENISPOIN_TERTIB_KU:
                $jenisPelanggaran = [
                    JENISPOIN_KU_TIDUR,
                    JENISPOIN_KU_NGOBROL,
                    JENISPOIN_KU_DUDUK_TIDAK_SESUAI,
                    JENISPOIN_KU_MAKAN,
                    JENISPOIN_KU_MAIN_HP,
                    JENISPOIN_TIDAK_TERTIB_KU,
                    JENISPOIN_KU_TRANSISI_TIDAK_TERTIB
                ];
                break;

            case JENISPOIN_PATUH_TUGAS:
                $jenisPelanggaran = [
                    JENISPOIN_TUGAS_TIDAK_LENGKAP,
                    JENISPOIN_TUGAS_TERLAMBAT
                ];
                break;

            case JENISPOIN_TIDAK_MELAKUKAN_KESALAHAN:
            // Tidak melakukan pelanggaran apapun
                $jenisPelanggaran = [];
                break;

            Default :
            //untuk penghargaan lain, tidak ada ketentuan tertentu
            return $users;
        }

        foreach ($users as $key => $user) {
            $exists = false;
            if (!empty($jenisPelanggaran)) {
                foreach ($jenisPelanggaran as $pelanggaranId) {
                    $exists = self::where('user_id', $user)
                        ->where('jenis_poin_id', $pelanggaranId)
                        ->whereDate('urutan_input', Carbon::parse($data['urutan_input'])->toDateString())
                        ->exists();

                    if ($exists) {
                        break;
                    }
                }
            } else {
                //khusus tidak melakukan pelanggaran dalam sehari
                $exists = self::where('user_id', $user)
                    ->whereDate('urutan_input', Carbon::parse($data['urutan_input'])->toDateString())
                    ->whereHas('jenispoin', function ($query) {
                        $query->where('category', CATEGORY_JENISPOIN_PELANGGARAN);
                    })
                    ->exists();
            }

            if ($exists) {
                unset($users[$key]);
            }
        }

        return $users;
    }

    /**
     * insertPoin, kalau dua kali mendapatkan poin yang sama akan dikalikan dua
     *
     * @param  mixed $userId
     * @param  mixed $jenispoin
     * @param  mixed $data
     * @return void
     */
    public static function insertPoin($userId, JenisPoin $jenispoin, $data)
    {
        $jenispoinId = $jenispoin->id;
        $tanggalInput = Carbon::parse($data['urutan_input'])->toDateString();

        if ($jenispoin->category == CATEGORY_JENISPOIN_PELANGGARAN) {
            if (self::where('user_id', $userId)->where('jenis_poin_id', $jenispoinId)->exists()) {
                $latestRecord = self::where('user_id', $userId)
                    ->where('jenis_poin_id', $jenispoinId)
                    ->orderBy('urutan_input', 'desc')
                    ->first(['urutan_input', 'poin']);

                if ($latestRecord) {
                    $latestRecordDate = $latestRecord->urutan_input->toDateString();
                    $poinTerakhir = $latestRecord->poin;

                    if ($latestRecordDate == $tanggalInput) {
                        if ($jenispoin->is_bintang == 1) {
                            $poinModif = $poinTerakhir;
                            $kata = $data['poin'] < $poinModif
                                ? "Kamu sudah pernah mendapatkan poin ini pada hari sebelumnya sehingga poin pelanggaran bertambah menjadi {$poinModif}."
                                : "";
                        } else {
                            $poinModif = $poinTerakhir + 2;
                            $kata = "Kamu sudah pernah mendapatkan poin ini pada hari ini sehingga poin pelanggaran bertambah menjadi {$poinModif}.";
                        }
                    } else {
                        if ($jenispoin->is_bintang == 1) {
                            $poinModif = $data['poin'] + $poinTerakhir;
                            $kata = "Kamu sudah pernah mendapatkan poin ini pada hari sebelumnya sehingga poin pelanggaran bertambah menjadi {$poinModif}.";
                        } else {
                            $count = self::where('user_id', $userId)
                                ->where('jenis_poin_id', $jenispoinId)
                                ->pluck('urutan_input')
                                ->map(function ($date) {
                                    return $date->toDateString();
                                })->unique()->count();
                            $poinModif = $data['poin'] + $count * $data['poin'];
                            $kata = "Kamu sudah pernah mendapatkan poin ini pada hari sebelumnya sehingga poin pelanggaran bertambah menjadi {$poinModif}.";
                        }
                    }

                    $data['alasan'] = $data['alasan']
                        ? "{$data['alasan']}. {$kata}"
                        : $kata;
                    $data['poin'] = $poinModif;
                }
            }
        }

        $data['user_id'] = $userId;
        $data['jenis_poin_id'] = $jenispoinId;

        try {
            self::create($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * insertPoinAbsensi
     *
     * @param  mixed $userId
     * @param  mixed $event
     * @return void
     */
    public static function insertPoinAbsensi($userId, Event $event)
    {
        $now = Carbon::now();

        // kalau lambat
        if ($now > $event->waktu_akhir) {
            // hitung waktu keterlamvatan
            $keterlambatan = Carbon::parse($event->waktu_akhir)->floatDiffInMinutes($now);

            if (User::find($userId)->is_maba) {
                // aturan untuk maba
                if ($keterlambatan > 30)
                    $idPoin = JENISPOIN_MABA_LAMBAT_31;
                else if ($keterlambatan >= 15)
                    $idPoin = JENISPOIN_MABA_LAMBAT_16_30;
                else
                    $idPoin = JENISPOIN_MABA_LAMBAT_0_15;
            } else {
                // aturan untuk panitia
                if ($keterlambatan > 30)
                    $idPoin = JENISPOIN_PANITIA_LAMBAT_31;
                else if ($keterlambatan >= 15)
                    $idPoin = JENISPOIN_PANITIA_LAMBAT_16_30;
                else if ($keterlambatan >= 10)
                    $idPoin = JENISPOIN_PANITIA_LAMBAT_10_15;
                else
                    $idPoin = JENISPOIN_PANITIA_LAMBAT_0_10;
            }

            $poin = JenisPoin::find($idPoin);
            $data = [
                'urutan_input' => $now,
                'poin' => $poin->poin,
                'alasan' => "Kamu melakukan absen pada " . formatDateIso($now, "dddd, D MMMM YYYY HH:mm:ss") . " . Kamu terlambat " . round($keterlambatan, 0) . " menit"
            ];
        } else {

            // khusus untuk maba tambahkan poin jika tepat waktu
            $poin = JenisPoin::find(JENISPOIN_TEPAT_WAKTU);
            $data = [
                'urutan_input' => $now,
                'poin' => $poin->poin,
                'alasan' => "Kamu melakukan absen pada " . formatDateIso($now, "dddd, D MMMM YYYY HH:mm:ss")
            ];
        }

        try {
            self::insertPoin($userId, $poin, $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function insertPoinAbsensiManual($userId, Event $event, $kategoriTerlambat)
    {
        $now = Carbon::now();

        if ($kategoriTerlambat !== 'Tepat Waktu') {
            // Determine the point type based on lateness category
            if (User::find($userId)->is_maba) {
                switch ($kategoriTerlambat) {
                    case '0-15 menit':
                        $idPoin = JENISPOIN_MABA_LAMBAT_0_15;
                        break;
                    case '15-30 menit':
                        $idPoin = JENISPOIN_MABA_LAMBAT_16_30;
                        break;
                    case '> 30 menit':
                        $idPoin = JENISPOIN_MABA_LAMBAT_31;
                        break;
                    default:
                        $idPoin = JENISPOIN_MABA_LAMBAT_0_15;
                        break;
                }
            } else {
                switch ($kategoriTerlambat) {
                    case '0-10 menit':
                        $idPoin = JENISPOIN_PANITIA_LAMBAT_0_10;
                        break;
                    case '10-15 menit':
                        $idPoin = JENISPOIN_PANITIA_LAMBAT_10_15;
                        break;
                    case '15-30 menit':
                        $idPoin = JENISPOIN_PANITIA_LAMBAT_16_30;
                        break;
                    case '> 30 menit':
                        $idPoin = JENISPOIN_PANITIA_LAMBAT_31;
                        break;
                    default:
                        $idPoin = JENISPOIN_PANITIA_LAMBAT_0_10;
                        break;
                }
            }

            $poin = JenisPoin::find($idPoin);
            $data = [
                'urutan_input' => $now,
                'poin' => $poin->poin,
                'alasan' => "Kamu terlambat kategori " . $kategoriTerlambat
            ];
        } else {
            // On time, give reward points
            $poin = JenisPoin::find(JENISPOIN_TEPAT_WAKTU);
            $data = [
                'urutan_input' => $now,
                'poin' => $poin->poin,
                'alasan' => "Kamu tepat waktu pada " . formatDateIso($now, "dddd, D MMMM YYYY HH:mm:ss")
            ];
        }

        try {
            self::insertPoin($userId, $poin, $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * getListPoin yang diperoleh oleh user
     *
     * @param  mixed $idUser
     * @param  mixed $withPaginate
     * @param  mixed $orderby
     * @param  mixed $category
     * @return void
     */
    public static function getListPoin($idUser, $withPaginate = false, $orderby = 'asc', $category = [])
    {
        $query = self::with(['user', 'jenispoin'])
            ->where('user_id', '=', $idUser);

        if (!empty($category))
            $query->whereHas('jenispoin', function (Builder $query) use ($category) {
                $query->whereIn('category', $category);
            });

        $query->orderby('urutan_input', $orderby);
        if ($withPaginate)
            return $query->paginate(4);

        return $query->get();
    }

    /**
     * getPoin berdasarkan category
     *
     * @param  mixed $idUser
     * @param  mixed $withPaginate
     * @param  mixed $orderby
     * @param  mixed $category
     * @return void
     */
    public static function getPoinByCategory($idUser, $withPaginate = false, $orderby = 'asc', ...$category)
    {
        return self::getListPoin($idUser, $withPaginate, $orderby, $category);
    }

    /**
     * hitung poin panitia
     *
     * @param  mixed $idPanitia
     * @return void
     */
    public static function calculatePoinPanitia($idPanitia)
    {
        $poin = POIN_AWAL_PANITIA;

        // panitia hanya punya jenis poin pelanggaran
        $allPoin = self::getPoinByCategory($idPanitia, false, 'asc', CATEGORY_JENISPOIN_PELANGGARAN);
        $pelanggaranList = collect();

        // tambahkan semua poin
        foreach ($allPoin as &$p) {
            if ($p->jenispoin->category == CATEGORY_JENISPOIN_PELANGGARAN) {
                $poin = $poin + $p->poin;
                $p->akumulasi_poin = $poin;
                $pelanggaranList->push($p);
            }
        }

        $lastpoin = $pelanggaranList->last();

        return collect([
            'akumulasi' => $lastpoin ? $lastpoin->akumulasi_poin : 0,
            'cadangan' => null,
            'list' => !empty($allPoin) ? $allPoin : null,
            'bonusList' => null,
            'penebusanList' => null,
            'pelanggaranList' => $pelanggaranList,
            'bonus' => 0,
            'pelanggaran' => $pelanggaranList ? $pelanggaranList->count('poin') : 0,
            'penebusan' => 0,
        ]);
    }

    /**
     * hitung poin maba
     *
     * @param  mixed $idMaba
     * @return void
     */
    public static function calculatePoinMaba($idMaba)
    {
        $poin = POIN_AWAL_MABA;
        $cadangan = 0;
        $allPoin = self::getListPoin($idMaba);

        $bonusList = collect();
        $pelanggaranList = collect();
        $penebusanList = collect();

        foreach ($allPoin as &$p) {

            $currentPoint = $p->poin;
            // jika poin  bonus
            if ($p->jenispoin->category == CATEGORY_JENISPOIN_PENGHARGAAN) {
                $poin = $poin + $currentPoint;
                // jika setelah ditambahkan melebihi batas maksimal maka poin akan diabaikan
                if ($poin > POIN_MAKSIMAL) {
                    $kelebihan = $poin - POIN_MAKSIMAL;
                    $poin = POIN_MAKSIMAL;
                    $p->keterangan = "Poin sudah melebihi maksimal. {$kelebihan} poin tidak terhitung";
                    $p->pertambahan = $currentPoint - $kelebihan;
                } else {
                    $p->pertambahan = $currentPoint;
                }
                $bonusList->push($p);
            }

            // jika poin pelanggaran
            if ($p->jenispoin->category == CATEGORY_JENISPOIN_PELANGGARAN) {
                // Jika ada cadangan maka kurangi dulu cadangannya
                if ($cadangan > 0) {
                    // kalau cadangan lebih besar maka semua poin pengurangan akan dikurangkan di poin cadangan
                    if ($cadangan > $currentPoint) {
                        $cadangan = $cadangan - $currentPoint;
                        $p->keterangan = "{$currentPoint} poin diambil dari poin cadangan";
                        $currentPoint = 0;
                    } else {
                        $currentPoint = $currentPoint - $cadangan;
                        $p->keterangan = "{$cadangan} poin diambil dari poin cadangan";
                        $cadangan = 0;
                    }
                }
                $poin = $poin - $currentPoint;
                $p->pertambahan = $currentPoint * -1;
                $pelanggaranList->push($p);
            }

            // jika poin merupakan poin penebusan
            if ($p->jenispoin->category == CATEGORY_JENISPOIN_PENEBUSAN) {
                if ($poin < POIN_MINIMUM) {
                    // jika setalah ditambah poin penebusan melebihi batas minimum maka poin yang berlebih akan menjadi poin cadangan
                    if ($poin + $currentPoint > POIN_MINIMUM) {
                        $kelebihan = ($poin + $currentPoint) - POIN_MINIMUM;
                        $cadangan = $cadangan + $kelebihan;

                        $p->keterangan = "Terdapat kelebihan {$kelebihan} poin setelah penebusan dan poin tersebut menjadi poin cadangan";
                        $p->pertambahan = POIN_MINIMUM - $poin;
                        $poin = POIN_MINIMUM;
                    } else {
                        $poin = $poin + $currentPoint;
                        $p->pertambahan = $currentPoint;
                    }
                } else {
                    // kalau poin lebih besar dari poin minimum maka otomatis masuk kedalam poin cadangan
                    $p->keterangan = "Terdapat kelebihan {$currentPoint} poin setelah penebusan dan poin tersebut menjadi poin cadangan";
                    $p->pertambahan = 0;
                    $cadangan = $cadangan + $currentPoint;
                }
                $penebusanList->push($p);
            }

            $p->akumulasi_poin = $poin;
            $p->cadangan = $cadangan;
        }
        $lastpoin = $allPoin->last();


        return collect([
            'akumulasi' => $lastpoin ? $lastpoin->akumulasi_poin : POIN_AWAL_MABA,
            'cadangan' => $lastpoin ? $lastpoin->cadangan : 0,
            'list' => !empty($allPoin) ? $allPoin : null,
            'bonusList' => $bonusList,
            'penebusanList' => $penebusanList,
            'pelanggaranList' => $pelanggaranList,
            'bonus' => $bonusList ? $bonusList->count('poin') : 0,
            'pelanggaran' => $pelanggaranList ? $pelanggaranList->count('poin') : 0,
            'penebusan' => $penebusanList ? $penebusanList->count('poin') : 0,
        ]);
    }


    /**
     * getJSONPoin, untuk line chart
     *
     * @param  mixed $poinList
     * @param  mixed $user_id
     * @return void
     */
    public static function getJSONPoin($user_id = null, $poinList = null)
    {
        $user = User::find($user_id);
        if (is_null($poinList))
            $poin = $user->getKalkulasiPoin()['list'];
        else
            $poin = $poinList;

        $poinAwal = $user->is_maba ? POIN_AWAL_MABA : POIN_AWAL_PANITIA;

        $data[] = [
            'jenis' => 'Poin Awal',
            'nama' => '',
            'poin' => $poinAwal,
            'cadangan' => 0,
            'y' => $poinAwal,
            'x' => 0,
            'title' => 'Poin Awal'
        ];

        $i = 1;
        if ($poin) {
            $poin->each(function ($item) use (&$data, &$i) {
                $data[] = [
                    'jenis' => MAP_CATEGORY['jenis_poin']['' . $item->jenispoin->category],
                    'nama' => $item->jenispoin->nama,
                    'poin' => $item->poin,
                    'alasan' => $item->alasan ?? null,
                    'keterangan' => $item->keterangan ?? null,
                    'pertambahan' => $item->pertambahan ?? null,
                    'cadangan' => $item->cadangan ?? 0,
                    'y' => $item->akumulasi_poin,
                    'time' => formatDateIso($item->updated_at, 'dddd, D MMMM YYYY HH:mm:ss') . ' WIB',
                    'x' => $i,
                    'title' => 'Poin ke-' . $i++
                ];
            });
        }
        return json_encode($data);
    }

    public static function getUnfinishedPenebusanPoin($user_id)
    {
        $j = JenisPoin::whereHas('penebusans', function (Builder $q) use (&$user_id) {
            $q->where('user_id', $user_id)
                ->where('status', '<>', 'Selesai');
        })->get();
        return $j->sum('poin');
    }
}
