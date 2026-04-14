<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\inven;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function ()  {
    return view('inventory.index');
});

Route::get('/', [Inven::class, 'index']);

Route::resource('products', Inven::class);

Route::resource(
    'inventory', inven::class
);

Route::resources([
    'inventory' => inven::class,
]); 