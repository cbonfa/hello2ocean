<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\FisherPasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {


    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login')->prefix('hydrosphere');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->prefix('hydrosphere');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request')->prefix('hydrosphere');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email')->prefix('hydrosphere');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset')->prefix('hydrosphere');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update')->prefix('hydrosphere');
});

Route::middleware('auth')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register')->prefix('hydrosphere');

    Route::post('register', [RegisteredUserController::class, 'store'])->prefix('hydrosphere');

    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm')->prefix('hydrosphere');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store'])->prefix('hydrosphere');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout')->prefix('hydrosphere');
});

Route::middleware('guest:fisher')->name('fisher.')->prefix('fisher')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create_fisher'])->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store_fisher']);

    Route::get('register', [RegisteredUserController::class, 'create_fisher'])->name('register');

    Route::post('register', [RegisteredUserController::class, 'store_fisher']);

    Route::get('forgot-password', [FisherPasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [FisherPasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');

});

Route::middleware('auth:fisher')->name('fisher.')->prefix('fisher')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy_fisher'])
    ->name('logout');
});
