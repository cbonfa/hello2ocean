<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FisherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the bootstrap/app.php within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fishers/verify/{fisher}', [FisherController::class, 'verify'])
    ->middleware('signed')
    ->name('fishers.verify');


# Change Language All Pages
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

# Change Language
// Route::get('/{locale?}', function ($locale = null) {
//     if (isset($locale) && in_array($locale, config('app.available_locales'))) {
//         app()->setLocale($locale);
//     }
//     return view('welcome');
// });

require __DIR__.'/auth.php';

