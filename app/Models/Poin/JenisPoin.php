<?php

namespace App\Models\Poin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPoin extends Model
{
    use HasFactory;
    protected $table = 'jenis_poin';
    protected $casts = [
        'urutan_input' => 'datetime:Y-m-d H:i:s'
    ];

    protected $guarded = [];

    /**
     * many to many dengan tabel user
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'jenis_poin_user')
            ->using(Poin::class)->as('poins')
            ->withPivot(['poin', 'alasan'])
            ->withTimestamps();
    }

    /**
     * accessor untuk nama jenis poin agar capitalize
     *
     * @param  mixed $nama
     * @return void
     */
    public function getNamaAttribute($nama)
    {
        return ucwords($nama);
    }

    /**
     * ambil jenis poin penebusan yang bisa dilakukan oleh maba
     *
     * @param  mixed $user_id
     * @return void
     */
    public static function getAvailablePenebusan($user_id)
    {
        // Sisa poin yang harus ditebus
        $poinKurang = POIN_MINIMUM - User::find($user_id)->getKalkulasiPoin()['akumulasi'];

        $semua = self::where('category', CATEGORY_JENISPOIN_PENEBUSAN)
            ->orderBy('poin', 'asc')
            ->get();
        $poinAvailable = $semua->unique('poin')->pluck('poin');
        $poinToGet = collect();

        foreach ($poinAvailable as $p) {
            if ($poinToGet->sum() + $p < $poinKurang) {
                $poinToGet->push($p);
            } elseif ($p >= $poinKurang) {
                $poinToGet = collect([$p]);
                break;
            } else {
                $poinToGet->push($p);
                $poinToGet = $poinToGet->sortDesc()->toArray();

                $res = collect();
                $i = sizeof($poinToGet) - 1;
                while ($res->sum() < $poinKurang) {
                    $res->push($poinToGet[$i]);
                    $i--;
                }

                $poinToGet = $res;
                break;
            }
        }

        $semua = self::where('category', CATEGORY_JENISPOIN_PENEBUSAN)
            ->whereIn('poin', $poinToGet)
            ->get();

        // Filter untuk penebusan yang sudah dipilih
        $user_jenispoin = self::whereHas('penebusans', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();

        // Filter untuk tipe penebusan yang sudah dipilih
        $type_jenispoin = self::where('category', CATEGORY_JENISPOIN_PENEBUSAN)
            ->whereIn('type', $user_jenispoin->unique('type')->pluck('type'))
            ->get();

        // Return semua penebusan kecuali penebusan dan tipe penebusan yang sudah dipilih
        // return $semua->diff($user_jenispoin)->diff($type_jenispoin);

        // Return semua penebusan kecuali penebusan yang sudah dipilih
        return $semua->diff($user_jenispoin);
    }

    /**
     * one to many denga jenis_poin_user
     *
     * @return void
     */
    public function poins()
    {
        return $this->hasMany(Poin::class, 'jenis_poin_id');
    }

    /**
     * one to many dengan penebusan
     *
     * @return void
     */
    public function penebusans()
    {
        return $this->hasMany(Penebusan::class, 'jenis_poin_id');
    }
}
