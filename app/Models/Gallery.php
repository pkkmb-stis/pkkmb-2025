<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';
    protected $guarded = [];

    /**
     * scopeFoto ketika category == 1
     *
     * @return void
     */
    public function scopeFoto()
    {
        return $this->where('category', CATEGORY_GALLERY_FOTO);
    }

    /**
     * scopeVideo ketika category == 2
     *
     * @return void
     */
    public function scopeVideo()
    {
        return $this->where('category', CATEGORY_GALLERY_VIDEO);
    }


    /**
     * accessor untuk url dari video atau foto
     *
     * @param  mixed $value
     * @return void
     */
    public function getFilenameAttribute($value)
    {
        // kalau foto berarti urlnya diarahin ke storage karena yang tersimpan adalah nama file
        if ($this->category == CATEGORY_GALLERY_FOTO)
            return storage($value);

        // kalau video ga perlu diapa apain karena sudah berupa link  yaoutube
        return $value;
    }

    //relasi ke model Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
