<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('upload-image')->group(function ($route): void {
    $route->get('/', [\App\Http\Controllers\UploadImageController::class, 'index']);
    $route->get('store', [\App\Http\Controllers\UploadImageController::class, 'store']);
});

Route::prefix('certs')->group(function ($route): void {
    $route->get('with-photo', [\App\Http\Controllers\CertificateController::class, 'withPhoto']);
    $route->get('without-photo', [\App\Http\Controllers\CertificateController::class, 'withoutPhoto']);
});

Route::prefix('greeting-card')->group(function ($route): void {
    $route->get('with-photo', [\App\Http\Controllers\GreetingCardController::class, 'withPhoto']);
    $route->get('without-photo', [\App\Http\Controllers\GreetingCardController::class, 'withoutPhoto']);
});
