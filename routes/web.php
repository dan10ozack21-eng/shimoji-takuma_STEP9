<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [ProductController::class, 'index'])->name('index');

Route::get('/product/create', [ProductController::class, 'create'])->name('create_product');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('detail');

Route::get('/purchase/{id}', [ProductController::class, 'purchase'])->name('purchase');

Route::get('/mypage', [ProductController::class, 'mypage'])->name('mypage');

Route::post('/product/store', [ProductController::class, 'store'])->name('store_product');

Route::get('/mypage/edit', [ProductController::class, 'editAccount'])->name('edit_account');

Route::post('/mypage/update', [ProductController::class, 'updateAccount'])->name('update_account');

Route::get('/contact', [ProductController::class, 'contact'])->name('contact');

Route::post('/contact/send', [ProductController::class, 'sendContact'])->name('send_contact');