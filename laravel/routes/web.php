<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FirstController;
use App\Events\YourEvent;
use App\Http\Livewire\UserChat;
use App\Http\Livewire\AdminChat; // Add this line

Route::get('/', function () {
    notify()->success('welcome to laravel notify');
    return view('welcome');
});

Auth::routes();

//Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('verified');
    Route::get('/search', [HomeController::class,'search']);
    Route::post('/rent-book/{oorderId}', [HomeController::class, 'rentBook'])->name('rentBook');
});

//Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});

//Admin Routes List
Route::middleware(['auth', 'user-access:manager'])->group(function () {
    Route::resource('/product', ProductController::class);
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});

Route::get('/first',[FirstController::class,'HOme']);
Route::get('/search2',[FirstController::class,'search']);



Route::get('/test', function () {
    event(new YourEvent('Hello from Laravel with Pusher!'));
    return 'Event has been fired!';
});



Auth::routes(['verify' => true]);



