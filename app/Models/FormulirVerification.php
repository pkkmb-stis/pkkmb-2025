<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormulirVerification extends Model
{
    use HasFactory;

    protected $fillable = ['nimb', 'formulir_id'];

    public function formulir()
    {
        return $this->belongsTo(Formulir::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nimb', 'nimb');
    }
}
