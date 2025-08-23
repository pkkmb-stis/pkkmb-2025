<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendala extends Model
{
    use HasFactory;

    protected $table = 'kendala';
    protected $guarded = [];

     protected $casts = [
        'waktu_kendala' => 'datetime',
    ];

    /**
     * one to many relation dengan user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
