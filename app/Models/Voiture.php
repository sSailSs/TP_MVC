<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voiture extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'marque',
        'modele',
        'reservoir',
        'qte_carburant',
    ];

    /**
     * The Rules that are created for each field.
     *
     * @var array<int, string>
     */
    public static $createRules = [
        'marque' => 'required|string|max:90',
        'modele' => 'required|string|max:90',
        'reservoir' => 'required|numeric|min:20|max:200', // Passé en numeric
        'qte_carburant' => 'required|numeric|min:0|lte:reservoir', // Passé en numeric
    ];
}
