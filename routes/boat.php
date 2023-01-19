<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoatController;
use App\Http\Controllers\ChatController;


Route::get('/', [BoatController::class, 'index'])->name('index');

Route::post('chat/send_message/{fisher}', [ChatController::class, 'sendMessage'])
    ->name('chat.send.message');