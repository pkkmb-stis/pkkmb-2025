<?php

namespace App\Models;

use App\Models\Poin\Poin;
use App\Models\Poin\JenisPoin;
use App\Models\Poin\Penebusan;
use Laravel\Sanctum\HasApiTokens;
use App\Models\FormulirVerification;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'alamat',
        'nowa',
        'himada',
        'angkatan',
        'is_active',
        'kabkot_id',
        'kelompok_id',
        'jenis_kelamin',
        'nama_statistik',
        'prodi',
        'profile_photo_path',
        'status_kelulusan',
        'nimb',
        'nomor_surat'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'is_maba',
    ];

    /**
     * one to one relationship for pendamping kelompok
     *
     * @return void
     */
    public function handleKelompok()
    {
        return $this->hasMany(Kelompok::class, 'lapk_user_id');
    }


    /**
     * relation between kelompok and users
     *
     * @return void
     */
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }

    /**
     * one to many relation dengan tabel jenis_poin_user
     *
     * @return void
     */
    public function poins()
    {
        return $this->hasMany(Poin::class, 'user_id');
    }

    /**
     * one to many relation dengan tabel penebusan
     *
     * @return void
     */
    public function penebusans()
    {
        return $this->hasMany(Penebusan::class);
    }

    /**
     * many to many dengan tabel event, untuk membuat list absensi
     *
     * @return void
     */
    public function event()
    {
        return $this->belongsToMany(Event::class, 'events_user')
            ->withPivot('status', 'alasan', 'link')->orderByPivot('created_at', 'desc')
            ->withTimestamps();
    }

    /**
     * one to many dengan tabel kendala
     *
     * @return void
     */
    public function kendala()
    {
        return $this->hasMany(Kendala::class, 'user_id');
    }

    /**
     * one to many dengan tabel kabupaten
     *
     * @return void
     */
    public function kabupaten()
    {
        return $this->hasOne(Kabkot::class, 'kabkot_id', 'kabkot_id');
    }

    /**
     * accessor to translate code jenis kelamin
     *
     * @return void
     */
    public function getJenisKelaminAttribute($jenisKelamin)
    {
        if ($jenisKelamin)
            return $jenisKelamin == "P" ? 'Perempuan' : 'Laki-Laki';
        return $jenisKelamin;
    }

    public function setJenisKelaminAttribute($jenisKelamin)
    {
        if ($jenisKelamin)
            $this->attributes['jenis_kelamin'] = $jenisKelamin == 'Laki-Laki' ? 'L' : 'P';
    }

    /**
     * accesor photo profile
     *
     * @return void
     */
    public function getProfilePhotoUrlAttribute()
    {
        $photo = $this->profile_photo_path;
        return $photo ? storage($photo) : 'https://ui-avatars.com/api/?background=F9A825&color=ffffff&name=' . $this->name;
    }

    /**
     * accessor to check if user is maba according to kelompok_id column
     *
     * @return void
     */
    public function getIsMabaAttribute()
    {
        return !is_null($this->kelompok_id);
    }

    /**
     * accessor to check if user is LAPK according to lapk_user_id column in table kelompok
     *
     * @return void
     */
    public function isLapk()
    {
        return $this->handleKelompok->count() > 0 ? true : false;
    }

    /**
     * getIp dari maba
     *
     * @return void
     */
    public function getIp()
    {
        if ($this->is_maba)
            return round(Indikator::getIPMaba($this->id), 2);
        return 0;
    }

    /**
     * getNilai dari maba beserta list indikatornya
     *
     * @return void
     */
    public function getNilai()
    {
        if ($this->is_maba)
            return Indikator::getNilaiMaba($this->id);
        return null;
    }


    /**
     * getPoins yang didapat oleh user, baik untuk maba atau panitia
     *
     * @param  mixed $withPaginate
     * @return void
     */
    public function getPoins($withPaginate = true)
    {
        if ($this->is_maba)
            return Poin::getListPoin($this->id, $withPaginate, 'desc');
        else if ($this->hasRole(ROLE_PANITIA))
            return Poin::getPoinByCategory($this->id, $withPaginate, 'desc', CATEGORY_JENISPOIN_PELANGGARAN);
        else
            return [];
    }

    public function formulirVerifications()
    {
        return $this->hasMany(FormulirVerification::class, 'nimb', 'nimb');
    }


    /**
     * hitung poin dari user
     *
     * @return void
     */
    public function getKalkulasiPoin()
    {
        if ($this->is_maba)
            return Poin::calculatePoinMaba($this->id);
        else if ($this->hasRole(ROLE_PANITIA))
            return Poin::calculatePoinPanitia($this->id);
        return [];
    }

    // public static function poinUser()
    // {
    //     $hasil = User::select('name', 'jenis_poin.category as kategori', Poin::raw('sum(jenis_poin_user.poin) as poin_sum'), 'jenis_poin_user.urutan_input as terakhir_update')
    //         ->join('jenis_poin_user', 'users.id', '=', 'jenis_poin_user.user_id')
    //         ->join('jenis_poin', 'jenis_poin_user.jenis_poin_id', '=', 'jenis_poin.id')
    //         ->groupBy('kategori', 'name')
    //         ->orderBy('poin_sum', 'asc')
    //         ->orderBy('kategori', 'asc');

    //     return $hasil;
    // }

    public static function poinUser()
    {
        $hasil = User::select('name', 'jenis_poin.category as kategori', JenisPoin::raw('count(jenis_poin.category) as kategori_count'), Poin::raw('sum(jenis_poin_user.poin) as poin_sum'), 'jenis_poin_user.urutan_input as terakhir_update')
            ->join('jenis_poin_user', 'users.id', '=', 'jenis_poin_user.user_id')
            ->join('jenis_poin', 'jenis_poin_user.jenis_poin_id', '=', 'jenis_poin.id')
            ->groupBy('kategori', 'name')
            ->orderBy('poin_sum', 'asc')
            ->orderBy('kategori_count', 'asc');

        return $hasil;
    }

    public static function poinKelompok()
    {
        $hasil = User::select('kelompok.nama as nama_kelompok', 'jenis_poin.category as kategori', Poin::raw('sum(jenis_poin_user.poin) as poin_sum'), 'jenis_poin_user.urutan_input as terakhir_update')
            ->join('kelompok', 'users.kelompok_id', '=', 'kelompok.id')
            ->join('jenis_poin_user', 'users.id', '=', 'jenis_poin_user.user_id')
            ->join('jenis_poin', 'jenis_poin_user.jenis_poin_id', '=', 'jenis_poin.id')
            ->groupBy('kategori', 'users.kelompok_id')
            ->orderBy('kategori', 'asc')
            ->orderBy('poin_sum', 'asc')
            ->orderBy('nama_kelompok', 'asc');

        return $hasil;
    }

    public static function rekapHarian()
    {
        $hasil = User::select('jenis_poin.category as kategori', JenisPoin::raw('count(jenis_poin.category) as kategori_count'), 'jenis_poin_user.urutan_input as terakhir_update')
            ->join('jenis_poin_user', 'users.id', '=', 'jenis_poin_user.user_id')
            ->join('jenis_poin', 'jenis_poin_user.jenis_poin_id', '=', 'jenis_poin.id')
            ->groupBy('kategori')
            ->orderBy('kategori', 'asc')
            ->orderBy('kategori_count', 'asc');

        return $hasil;
    }
}
