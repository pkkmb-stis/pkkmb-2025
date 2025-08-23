<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publishable extends Model
{
    use HasFactory;
    protected $table = 'publishable';
    protected $guarded = [];
    
     protected $casts = [
        'publish_datetime' => 'datetime',
    ];
    /**
     * untuk query hanya pengumuman
     *
     * @param  mixed $query
     * @return void
     */
    public function scopePengumuman($query)
    {
        return $query->where('category', CATEGORY_PUBLISHABLE_PENGUMUMAN);
    }

    /**
     * untuk query hanya materi
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeMateri($query)
    {
        return $query->where('category', CATEGORY_PUBLISHABLE_MATERI);
    }

    /**
     * untuk query hanya sertifikat
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeSertifikat($query)
    {
        return $query->where('category', CATEGORY_PUBLISHABLE_SERTIFIKAT);
    }

    /**
     * untuk query hanya laporan kegiatan
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeLaporanKegiatan($query)
    {
        return $query->where('category', CATEGORY_PUBLISHABLE_LAPORAN_KEGIATAN);
    }

    public function users()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
