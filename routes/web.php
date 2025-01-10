<?php

use App\Livewire\Users\UserIndex;
use App\Livewire\Cities\CityIndex;
use App\Livewire\States\StateIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Countries\CountryIndex;
use App\Livewire\Departments\DepartmentIndex;
use App\Http\Controllers\Users\UsersController;
use App\Livewire\Employees\EmployeeIndex;

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
    Route::get('/states', StateIndex::class)->name('states.index');
    Route::get('/cities', CityIndex::class)->name('cities.index');
    Route::get('/departments', DepartmentIndex::class)->name('departments.index');
    Route::get('/employees', EmployeeIndex::class)->name('employees.index');
});
