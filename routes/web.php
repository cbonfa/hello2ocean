<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FisherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if($this->app->environment('production')) {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fishers/verify/{fisher}', [FisherController::class, 'verify'])
    ->middleware('signed')
    ->name('fishers.verify');


require __DIR__.'/auth.php';
