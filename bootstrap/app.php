<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
     $middleware->alias([
        'role' => RoleMiddleware::class,
    ]);
    
    // Ensure API routes are strictly stateless
    $middleware->api(remove: [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
    ]);
    
    // Exclude API routes from CSRF and session middleware
    $middleware->validateCsrfTokens(except: [
        '*',
    ]);
    
    // Set default redirect for unauthenticated users
    $middleware->redirectTo(function () {
        return '/login';
    });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
