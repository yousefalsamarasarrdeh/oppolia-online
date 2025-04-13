<?php
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
    web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'set-locale' => \App\Http\Middleware\LocaleMiddleware::class,
        'designer' => \App\Http\Middleware\DesignerMiddleware::class,
        'adminOrsales_manager' => \App\Http\Middleware\AdminOrSalesManagerMiddleware::class,
        'adminOrsales_managerOrarea_manager' => \App\Http\Middleware\AdminOrSalesManagerOrAreaManagerMiddleware::class,
        'adminOrsales_managerOrarea_managerOrDesginer' => \App\Http\Middleware\AdminOrSalesManagerOrAreaManagerOrDesignerMiddleware::class,
    ]);

    // هون بنضيف توجيه الضيوف (اللي مش مسجلين دخول)
    $middleware->redirectGuestsTo(function (Request $request) {
        return '/';
    });
})
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
