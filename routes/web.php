<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [ProductController::class, 'index']);

Route::get('/product/{id}', [ProductController::class, 'show'])->name('detail');

Route::get('/purchase/{id}', [ProductController::class, 'purchase'])->name('purchase');

Route::get('/mypage', [ProductController::class, 'mypage'])->name('mypage');