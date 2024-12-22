<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware(["auth"])->as("product.")->prefix("product/")->group(function () {
    Route::get("show", [AjaxController::class, "show"])->name("show");
    Route::post("store", [AjaxController::class, "store"])->name("store");
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
