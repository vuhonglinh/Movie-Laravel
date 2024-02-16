<?php

use Illuminate\Support\Facades\Route;
use Modules\Countries\src\Http\Controllers\CountryController;

Route::prefix('admin/countries')->name('admin.countries.')->group(function () {
       Route::get('/', [CountryController::class, 'index'])->name('index');
       Route::get('/data', [CountryController::class, 'data'])->name('data');

       Route::get('/add', [CountryController::class, 'add'])->name('add');
       Route::post('/add', [CountryController::class, 'create'])->name('create');

       Route::get('/edit/{id}', [CountryController::class, 'edit'])->name('edit');
       Route::post('/edit/{id}', [CountryController::class, 'update'])->name('update');

       Route::get('/delete/{id}', [CountryController::class, 'delete'])->name('delete');
});
