<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carburant extends Model
{
    use HasFactory;

    protected $fillable = ['type']; // Type de carburant : SP95, SP98 ...

    public static $rules = [
        'type' => 'required|string|in:SP95,SP95-E10,SP98,Gazole',
    ];

    public function citernes()
    {
        return $this->hasMany(Citerne::class);
    }
}
