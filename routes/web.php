<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/public/{hash}',[App\Http\Controllers\CertificateController::class, 'view'])->name('view');

Auth::routes();

Route::any('/certificate', [App\Http\Controllers\CertificateController::class, 'create'])->name('certificate.add');
Route::get('/certificate/send/{id}', [App\Http\Controllers\CertificateController::class, 'sendCertificate'])->name('certificate.send.email');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
