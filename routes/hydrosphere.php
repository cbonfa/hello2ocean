<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FisherController;

Route::get('/', function () {
    return view('hydrosphere');
})->name('hydrosphere');

Route::get('fishers', [FisherController::class, 'all'])
    ->name('fishers.all');