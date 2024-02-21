<?php

use Illuminate\Support\Facades\Route;
use Modules\Packages\src\Http\Controllers\PackageController;

Route::prefix('admin/packages')->name('admin.packages.')->group(function () {
       Route::get('/', [PackageController::class, 'index'])->name('index');
       Route::get('/data', [PackageController::class, 'data'])->name('data');

       Route::get('/add', [PackageController::class, 'add'])->name('add')->can('packages.add');
       Route::post('/add', [PackageController::class, 'create'])->name('create')->can('packages.add');

       Route::get('/edit/{id}', [PackageController::class, 'edit'])->name('edit')->can('packages.edit');
       Route::post('/edit/{id}', [PackageController::class, 'update'])->name('update')->can('packages.edit');

       Route::get('/delete/{id}', [PackageController::class, 'delete'])->name('delete')->can('packages.delete');
});
