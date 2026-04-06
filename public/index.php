<?php

define('LARAVEL_START', microtime(true));

// Register Composer autoloader
if (!file_exists(__DIR__.'/../vendor/autoload.php')) {
    header("HTTP/1.1 503 Service Unavailable");
    echo "Composer autoload not found. Please run 'composer install'.";
    exit(1);
}

require __DIR__.'/../vendor/autoload.php';

// Bootstrapping the application
$app = require_once __DIR__.'/../bootstrap/app.php';

// Handle the request and send the response
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);