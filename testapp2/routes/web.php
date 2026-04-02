<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\TransactionController;

Route::resource('item', ItemController::class);
Route::resource('item.batch', BatchController::class);
Route::resource('item.transaction', TransactionController::class);

Route::get('/', function () {
    return redirect('/item');
});

Route::get('/export', function() {
    return view('export');
}) -> name('export');

Route::get('/settings', function() {
    return view('settings');
}) -> name('settings');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
