<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\inven;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function ()  {
    return view('home');
});

Route::resource(
    'inventory', inven::class
);

Route::resources([
    'inventory' => inven::class,
]); 