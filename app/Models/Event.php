<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $guarded = [];

     protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_akhir' => 'datetime',
    ];

    /**
     * scopePresensi untuk presensi yaitu ketika categorynya == 1
     *
     * @return void
     */
    public function scopePresensi()
    {
        return $this->where('category', CATEGORY_EVENT_PRESENSI);
    }

    /**
     * scopePresensi untuk timeline yaitu ketika categorynya == 2
     *
     * @return void
     */
    public function scopeTimeline()
    {
        return $this->where('category', CATEGORY_EVENT_TIMELINE)
            ->orderBy('waktu_mulai', 'asc')
            ->orderBy('waktu_akhir', 'asc');
    }

    /**
     * relation many to many dengan tabel user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsToMany(User::class, 'events_user')->withPivot('status', 'alasan', 'created_at', 'updated_at');
    }

    /**
     * accessor untuk is_pasca
     *
     * @param  mixed $value
     * @return void
     */
    public function getIsPascaAttribute($value)
    {
        return $value ? 'Pasca PKKMB' : 'Masa PKKMB';
    }

    //relasi ke model Gallery
    // Di dalam model Event
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'event_id');
    }
}
