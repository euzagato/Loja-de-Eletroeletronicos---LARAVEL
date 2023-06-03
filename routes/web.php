<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('', function () {
    return view('welcome');
});

Route::get('/produtos', function () {
    return view('produtos.index');
});

Route::resource('produtos', ProdutoController::class);