<?php

use Illuminate\Support\Facades\Route;
use Modules\Categories\src\Http\Controllers\CategoryController;

Route::prefix('admin/categories')->name('admin.categories.')->group(function () {
       Route::get('/', [CategoryController::class, 'index'])->name('index');
       Route::get('/data', [CategoryController::class, 'data'])->name('data');

       Route::get('/add', [CategoryController::class, 'add'])->name('add');
       Route::post('/add', [CategoryController::class, 'create'])->name('create');

       Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
       Route::post('/edit/{id}', [CategoryController::class, 'update'])->name('update');

       Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
})->middleware('auth:');
