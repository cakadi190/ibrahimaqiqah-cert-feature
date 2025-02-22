<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('certs')->group(function ($route): void {
    $route->get('with-photo', [\App\Http\Controllers\CertificateController::class, 'withPhoto']);
    $route->get('without-photo', [\App\Http\Controllers\CertificateController::class, 'withoutPhoto']);
});

Route::prefix('greeting-card')->group(function ($route): void {
    $route->get('with-photo', [\App\Http\Controllers\GreetingCardController::class, 'withPhoto']);
    $route->get('without-photo', [\App\Http\Controllers\GreetingCardController::class, 'withoutPhoto']);
});
