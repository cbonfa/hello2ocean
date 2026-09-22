<?php

use App\Http\Middleware\HttpsProtocol;
use App\Http\Middleware\Localization;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['web', 'auth'])
                ->prefix('hydrosphere')
                ->name('hydrosphere.')
                ->group(base_path('routes/hydrosphere.php'));

            Route::middleware(['web', 'auth:fisher'])
                ->prefix('boat')
                ->name('boat.')
                ->group(base_path('routes/boat.php'));
        },
    )
    ->withBroadcasting(
        __DIR__.'/../routes/channels.php',
        ['middleware' => ['web', 'auth:fisher']],
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            HttpsProtocol::class,
            Localization::class,
        ]);

        $middleware->throttleApi();

        // Antes em app/Exceptions/Handler::unauthenticated()
        $middleware->redirectGuestsTo(fn (Request $request) => $request->is('boat', 'boat/*')
            ? route('fisher.login')
            : route('login'));

        // Antes em app/Http/Middleware/RedirectIfAuthenticated
        $middleware->redirectUsersTo(fn (Request $request) => $request->is('fisher', 'fisher/*')
            ? '/boat'
            : '/hydrosphere');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->dontFlash([
            'current_password',
            'password',
            'password_confirmation',
        ]);

        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
