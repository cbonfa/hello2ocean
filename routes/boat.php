<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoatController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Boat\FisherController;

Route::get('/', [BoatController::class, 'index'])->name('index');

# ------------------------------------------------------------------------------
# FISHER DETAILS EDIT
# ------------------------------------------------------------------------------
Route::get('edit', [FisherController::class, 'edit'])->name('fisher.edit');

# ------------------------------------------------------------------------------
# CHAT ROUTES
# ------------------------------------------------------------------------------
Route::post('chat/send_message/{fisher}', [ChatController::class, 'sendMessage'])
    ->name('chat.send.message');

Route::post('chat/get_messages/{fisher}', [ChatController::class, 'getMessages'])
    ->name('chat.get.messages');

Route::post('chat/get_net', [ChatController::class, 'getNet'])
    ->name('chat.get.net');

Route::post('chat/add_net/{fisher}', [ChatController::class, 'addNet'])
    ->name('chat.add.net');