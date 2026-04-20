<?php

use App\Http\Controllers\aktivitas;
use App\Http\Controllers\inven;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('inventory.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [inven::class, 'index'])->name('inventory.index');
    Route::resource('inventory', inven::class);
});

Route::get('/', function () {
    return auth()->check() ? redirect('/inventory') : redirect('/login');
});

Route::get('logs', [aktivitas::class, 'index'])->name('inventory.logs');

require __DIR__.'/auth.php';
