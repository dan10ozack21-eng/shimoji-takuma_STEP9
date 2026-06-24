<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [ProductController::class, 'index'])->name('index');

Route::get('/product/create', [ProductController::class, 'create'])->name('create_product');

Route::get('/product/search', [ProductController::class, 'search'])->name('search');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('detail');

Route::get('/purchase/{id}', [ProductController::class, 'purchase'])->name('purchase');

Route::get('/mypage', [ProductController::class, 'mypage'])->name('mypage');

Route::post('/product/store', [ProductController::class, 'store'])->name('store_product');

Route::get('/mypage/edit', [ProductController::class, 'editAccount'])->name('edit_account');

Route::post('/mypage/update', [ProductController::class, 'updateAccount'])->name('update_account');

Route::get('/contact', [ProductController::class, 'contact'])->name('contact');

Route::post('/contact/send', [ProductController::class, 'sendContact'])->name('send_contact');

Route::get('/mypage/product/{id}', [ProductController::class, 'showMyProduct'])->name('mypage_product_detail');

Route::post('/mypage/product/{id}/delete', [ProductController::class, 'destroyProduct'])->name('mypage_product_destroy');

Route::get('/mypage/product/{id}/edit', [ProductController::class, 'editMyProduct'])->name('mypage_product_edit');

Route::post('/mypage/product/{id}/update', [ProductController::class, 'updateMyProduct'])->name('mypage_product_update');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

