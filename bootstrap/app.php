<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\TokenMismatchException; 
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'is_active' => \App\Http\Middleware\CheckIsActive::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (TokenMismatchException $e, Request $request) {
            return redirect()->route('login')->with('error', 'Sesi Anda telah berakhir karena terlalu lama tidak ada aktivitas. Silakan login kembali.');
        });     

        $exceptions->render(function (PostTooLargeException $e, Request $request) {
            return back()->withInput()->withErrors([
                'images' => 'Total ukuran file melebihi batas maksimal server. Pastikan setiap gambar maksimal 2MB.'
            ]);
        });
    })->create();
