<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UsersController;
use App\Livewire\Countries\CountryIndex;
use App\Livewire\Users\UserIndex;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/users', UserIndex::class)->name('users.index');
    Route::get('/countries', CountryIndex::class)->name('countries.index');
});
