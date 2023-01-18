<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoatController;


Route::get('/', [BoatController::class, 'index'])->name('index');

Route::post('chat/send_message', [ChatController::class, 'sendMessage'])
    ->name('chat.send.message');