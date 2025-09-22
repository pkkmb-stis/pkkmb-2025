<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'description'];
    
    protected $casts = [
        'date' => 'date'
    ];

    /**
     * Method sederhana untuk get tanggal berdasarkan nama hari
     *
     * @param string $name
     * @return \Carbon\Carbon|null
     */
    public static function getDateByName($name)
    {
        return self::where('name', $name)->first()?->date;
    }

    /**
     * Method untuk get all days untuk dropdown options
     *
     * @return array
     */
    public static function getDropdownOptions()
    {
        return self::orderBy('date')->pluck('name', 'name')->toArray();
    }

    /**
     * Method untuk get dropdown dengan description sebagai label
     *
     * @return array
     */
    public static function getDropdownOptionsWithDescription()
    {
        return self::orderBy('date')->get()->pluck('description', 'name')->toArray();
    }

    /**
     * Accessor untuk format tanggal Indonesia
     *
     * @return string
     */
    public function getFormattedDateAttribute()
    {
        return $this->date->format('d F Y');
    }
}
