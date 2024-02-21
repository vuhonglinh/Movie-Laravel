<?php

use Illuminate\Support\Facades\Route;
use Modules\Countries\src\Http\Controllers\CountryController;
use Modules\Countries\src\Models\Country;

Route::middleware(['can:countries', 'auth'])->prefix('admin/countries')->name('admin.countries.')->group(function () {
       Route::get('/', [CountryController::class, 'index'])->name('index');
       Route::get('/data', [CountryController::class, 'data'])->name('data');

       Route::get('/add', [CountryController::class, 'add'])->name('add')->can('countries.add', Country::class);
       Route::post('/add', [CountryController::class, 'create'])->name('create')->can('countries.add', Country::class);

       Route::get('/edit/{id}', [CountryController::class, 'edit'])->name('edit')->can('countries.edit', Country::class);
       Route::post('/edit/{id}', [CountryController::class, 'update'])->name('update')->can('countries.edit', Country::class);

       Route::get('/delete/{id}', [CountryController::class, 'delete'])->name('delete')->can('countries.delete', Country::class);
});
