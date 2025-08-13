<?php

namespace App\Models\Poin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Penebusan extends Model
{
    use HasFactory;

    protected $table = "penebusan_user";
    protected $guarded = [];
    protected $casts = [
        'accepted_at' => 'datetime:Y-m-d H:i:s',
        'submited_at' => 'datetime:Y-m-d H:i:s',
        'taken_at' => 'datetime:Y-m-d H:i:s',
        'deadline' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * one to one dengan tabel user
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
     * relation with jenis_poin_user
     *
     * @return void
     */
    public function poin()
    {
        return $this->belongsTo(Poin::class, 'poin_id');
    }

    /**
     * refreshStatus, untuk cek apakah ada penebusan yang sudah terlambat
     *
     * @return void
     */
    public static function refreshStatus()
    {
        $now = now();
        $all = self::where('status', PENEBUSAN_MENUNGGU_UPLOAD)
            ->orWhere('status', PENEBUSAN_BUTUH_REVISI)
            ->get();

        $all->each(function ($pene) use ($now) {
            if ($now->addSeconds(10)->gt($pene->deadline)) {
                $pene->update([
                    'status' => PENEBUSAN_TERLAMBAT
                ]);
            }
        });
    }
}
