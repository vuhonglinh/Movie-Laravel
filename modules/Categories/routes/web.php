<?php

use Illuminate\Support\Facades\Route;
use Modules\Categories\src\Http\Controllers\CategoryController;
use Modules\Categories\src\Models\Category;

Route::middleware(['can:categories', 'auth'])->prefix('admin/categories')->name('admin.categories.')->group(function () {
       Route::get('/', [CategoryController::class, 'index'])->name('index');
       Route::get('/data', [CategoryController::class, 'data'])->name('data');

       Route::get('/add', [CategoryController::class, 'add'])->name('add')->can('categories.add', Category::class);
       Route::post('/add', [CategoryController::class, 'create'])->name('create')->can('categories.add', Category::class);

       Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit')->can('categories.edit', Category::class);
       Route::post('/edit/{id}', [CategoryController::class, 'update'])->name('update')->can('categories.edit', Category::class);

       Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('delete')->can('categories.delete', Category::class);
})->middleware('can:categories');
