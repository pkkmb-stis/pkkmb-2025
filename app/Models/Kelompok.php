<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Kelompok extends Model
{
    use HasFactory;
    protected $table = 'kelompok';
    protected $guarded = [];

    /**
     * one kelompok just has one pendamping
     *
     * @return void
     */
    public function pendamping()
    {
        return $this->hasOne(User::class, 'id', 'lapk_user_id');
    }

    /**
     * one to many relationship between kelompok and anggota
     *
     * @return void
     */
    public function anggota()
    {
        return $this->hasMany(User::class, 'kelompok_id')->orderBy('name');
    }
}