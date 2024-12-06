<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationEssence extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'localisation',
        'total_citernes',
        'qte_carburant',
    ];

    /**
     * The Rules that are created for each field.
     *
     * @var array<int, string>
     */
    public static $createRules = [
        'nom' => 'required|string|max:90',
        'localisation' => 'required|string|max:90',
        'total_citernes' => 'required|numeric|min:5000|max:20000',
        'qte_carburant' => 'required|numeric|min:0|lte:total_citernes',
    ];

    /**
     * Relation: A station has many citernes.
     */
    public function citernes()
    {
        return $this->hasMany(Citerne::class);
    }
}
