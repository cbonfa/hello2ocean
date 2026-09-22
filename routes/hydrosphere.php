<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FisherController;
use App\Http\Controllers\Hydrosphere\WaveController;
use App\Http\Controllers\Hydrosphere\CountryController;
use App\Http\Controllers\Hydrosphere\LanguageController;
use App\Models\Country;
use App\Models\Fisher;
use App\Models\Language;
use App\Models\Wave;

Route::get('/', function () {
    return view('hydrosphere', [
        'counts' => [
            'fishers' => Fisher::count(),
            'waves' => Wave::count(),
            'languages' => Language::count(),
            'countries' => Country::count(),
        ],
    ]);
})->name('index');

Route::get('fishers', [FisherController::class, 'all'])
    ->name('fishers.all');

Route::get('waves/search', [WaveController::class, 'search'])->name('waves.search');
Route::resource('waves', WaveController::class);

Route::resource('languages', LanguageController::class);

Route::resource('countries', CountryController::class);