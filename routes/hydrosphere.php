<?php

use App\Http\Controllers\FisherController;
use App\Http\Controllers\Hydrosphere\AffinityThresholdController;
use App\Http\Controllers\Hydrosphere\CountryController;
use App\Http\Controllers\Hydrosphere\LanguageController;
use App\Http\Controllers\Hydrosphere\WaveController;
use App\Models\AffinityThreshold;
use App\Models\Country;
use App\Models\Fisher;
use App\Models\Language;
use App\Models\Wave;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('hydrosphere', [
        'counts' => [
            'fishers' => Fisher::count(),
            'waves' => Wave::count(),
            'languages' => Language::count(),
            'countries' => Country::count(),
            'affinity_thresholds' => AffinityThreshold::count(),
        ],
    ]);
})->name('index');

Route::get('fishers', [FisherController::class, 'all'])
    ->name('fishers.all');

Route::get('waves/search', [WaveController::class, 'search'])->name('waves.search');
Route::resource('waves', WaveController::class);

Route::resource('languages', LanguageController::class);

Route::resource('countries', CountryController::class);

Route::resource('affinity-thresholds', AffinityThresholdController::class)
    ->names('affinity_thresholds')
    ->parameters(['affinity-thresholds' => 'affinity_threshold']);
