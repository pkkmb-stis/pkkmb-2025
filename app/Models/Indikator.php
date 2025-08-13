<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;
    protected $table = 'indikator';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsToMany(User::class, 'indikator_users', 'indikator_id', 'ternilai_id');
    }

    /**
     * getNilaiMaba beserta indikatornya
     *
     * @param  mixed $userId
     * @return void
     */
    public static function getNilaiMaba($userId)
    {
        return self::select('indikator.*', 'indikator_users.nilai')
            ->leftjoin('indikator_users', function ($join) use ($userId) {
                $join->on('indikator.id', '=', 'indikator_users.indikator_id')
                    ->where('indikator_users.ternilai_id', '=', $userId);
            })
            ->orderBy('dimensi')
            ->orderBy('nama')
            ->get();
    }

    /**
     * fungsi untuk menghitung IP dari Maba
     *
     * @param  mixed $userId
     * @return void
     */
    public static function getIPMaba($userId)
    {
        $indikator = self::getNilaiMaba($userId);
        $totalSKS = $indikator->sum('sks');
        $totalNilai = $indikator->reduce(function ($carry, $item) {
            return $carry + ($item->sks * getBobotNilai($item->nilai));
        }, 0);

        return $totalNilai / $totalSKS;
    }
}
