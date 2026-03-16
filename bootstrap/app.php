<?php

use App\Http\Middleware\IsRevisor;
use App\Http\Middleware\IsAdmin; // Assicurati di importare il middleware IsAdmin
use Illuminate\Foundation\Application;
use App\Http\Middleware\SetLocaleMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    //! Accesso esclusivo zona Revisori
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isRevisor' => IsRevisor::class,
            'isAdmin' => IsAdmin::class, // Aggiungi qui il middleware isAdmin
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Gestione delle eccezioni
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [SetLocaleMiddleware::class]);
    })
    ->create();
