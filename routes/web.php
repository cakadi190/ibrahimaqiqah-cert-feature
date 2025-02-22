<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::name('upload-image.')->prefix('upload-image')->group(function ($route): void {
    $route->get('/', [\App\Http\Controllers\UploadImageController::class, 'index'])->name('index');
    $route->post('store', [\App\Http\Controllers\UploadImageController::class, 'store'])->name('store');
});

Route::name('certificates.')->prefix('certs')->group(function ($route): void {
    $route->get('with-photo', [\App\Http\Controllers\CertificateController::class, 'withPhoto'])->name('with-photo');
    $route->get('without-photo', [\App\Http\Controllers\CertificateController::class, 'withoutPhoto'])->name('without-photo');
});

Route::name('greeting-cards.')->prefix('greeting-card')->group(function ($route): void {
    $route->get('with-photo', [\App\Http\Controllers\GreetingCardController::class, 'withPhoto'])->name('with-photo');
    $route->get('without-photo', [\App\Http\Controllers\GreetingCardController::class, 'withoutPhoto'])->name('without-photo');
});
