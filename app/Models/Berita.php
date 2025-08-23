<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'berita';
    protected $fillable = ['judul', 'content', 'category', 'published_by', 'slug', 'published_datetime', 'hastag', 'thumbnails'];


     protected $casts = [
        'published_datetime' => 'datetime',
    ];
}
