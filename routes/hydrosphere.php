<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FisherController;
use App\Http\Controllers\WaveController;

Route::get('/', function () {
    return view('hydrosphere');
})->name('index');

Route::get('fishers', [FisherController::class, 'all'])
    ->name('fishers.all');

Route::resource('waves', WaveController::class);