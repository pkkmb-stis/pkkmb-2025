<?php

namespace App\Models;

use App\Models\FormulirVerification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formulir extends Model
{
    use HasFactory;

    protected $table = 'formulir';

    protected $fillable = [
        'spreadsheet_id',
        'nama_formulir',
        'is_visible',
        'link_form',
        'search_range',
        'nama_sheet'
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];


    public function verifications()
    {
        return $this->hasMany(FormulirVerification::class);
    }
}
