<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;

Route::resource('item', ItemController::class);
Route::resource('item.batch', BatchController::class);
Route::resource('item.transaction', TransactionController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect('/item');
    });
    
    Route::get('/home', function () {
        return redirect('/item');
    }) -> name('home');

    Route::get('/export', function() {
        return view('export');
    }) -> name('export');
    
    Route::post('/export', [ItemController::class, 'export']) -> name('export');

    Route::get('/settings', function() {
        return view('settings');
    }) -> name('settings');

    Route::get('/nurses', function() {
        $users = User::all();
        return view('nurses', compact('users'));
    }) -> name('nurses');

    Route::get('/nurse/{id}', function(int $id) {
        if (Auth::user()->admin) {
            $user = User::findOrFail($id);
            return view('nurse', compact('user'));
        } else {
            return redirect('/nurses');
        }
    }) -> name('nurse');

    Route::get('/promote/{id}', function(int $id) {
        if (Auth::user()->admin) {
            $curr_head = Auth::user();
            $new_head = User::findOrFail($id);
            $curr_head->admin = false;
            $new_head->admin = true;
            $curr_head->save();
            $new_head->save();
        }
        return redirect('/item');
    }) -> name('promote');

    Route::get('/unregister/{id}', function(int $id) {
        if (Auth::user()->admin) {
            $user = User::findOrFail($id);
            $user->delete();
        }
        return redirect('/item');
    }) -> name('unregister');
});

Auth::routes([
    'register' => false,
]);

Route::get('/register', function() {
    return view('auth.register');
}) -> name('register');

Route::post('/register', [RegisterController::class, 'register']) -> name('register');