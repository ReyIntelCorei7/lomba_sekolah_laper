<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin.auth' => \App\Http\Middleware\AdminAuth::class,
            'two-factor' => \App\Http\Middleware\TwoFactorAuth::class,
            'check-permission' => \App\Http\Middleware\CheckPermission::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle 404 Not Found errors
        $exceptions->render(function (NotFoundHttpException $e) {
            return response()->view('errors.404', [], 404);
        });

        // Handle Model Not Found (e.g., when a record doesn't exist)
        $exceptions->render(function (ModelNotFoundException $e) {
            return response()->view('errors.404', [], 404);
        });
    })->create();
