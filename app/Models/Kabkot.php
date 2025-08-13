<?php

namespace App\Models;

use App\Models\Poin\Poin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabkot extends Model
{
    use HasFactory;
    protected $table = 'kabkot';
    protected $primaryKey = 'kabkot_id';
    protected $fillable = ['provinsi_id', 'nama'];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'prov_id', 'prov_id');
    }
}
