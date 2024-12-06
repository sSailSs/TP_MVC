<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Citerne extends Model
{
    use HasFactory;

    protected $fillable = ['station_essence_id', 'carburant_id', 'capacite', 'qte_carburant'];

    public static $rules = [
        'capacite' => 'required|numeric|min:0',
        'qte_carburant' => 'required|numeric|min:0|max:capacite', // La quantité doit être inférieure ou égale à la capacité
    ];

    public function stationEssence()
    {
        return $this->belongsTo(StationEssence::class);
    }

    public function carburant()
    {
        return $this->belongsTo(Carburant::class);
    }
}
