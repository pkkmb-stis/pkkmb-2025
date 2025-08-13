<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = 'provinsi';
    protected $primaryKey = "prov_id";
    protected $fillable = ['nama'];

    /**
     * one to many relationship between kelompok and anggota
     *
     * @return void
     */
    public function kabkot()
    {
        return $this->hasMany(Kabkot::class, 'prov_id', 'prov_id');
    }
}
