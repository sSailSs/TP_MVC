<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoitureController;
use App\Http\Controllers\StationEssenceController;
use App\Http\Controllers\CarburantController;
use App\Http\Controllers\CiterneController;


Route::get('/', function () {
    return view('home');
});

Route::resource('voitures', VoitureController::class);
Route::resource('stationEssences', StationEssenceController::class);
Route::resource('carburants', CarburantController::class);
Route::resource('citernes', CiterneController::class);
