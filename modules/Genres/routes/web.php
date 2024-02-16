<?php

use Illuminate\Support\Facades\Route;
use Modules\Genres\src\Http\Controllers\GenreController;

Route::prefix('admin/genres')->name('admin.genres.')->group(function () {
       Route::get('/', [GenreController::class, 'index'])->name('index');
       Route::get('/data', [GenreController::class, 'data'])->name('data');

       Route::get('/add', [GenreController::class, 'add'])->name('add');
       Route::post('/add', [GenreController::class, 'create'])->name('create');

       Route::get('/edit/{id}', [GenreController::class, 'edit'])->name('edit');
       Route::post('/edit/{id}', [GenreController::class, 'update'])->name('update');

       Route::get('/delete/{id}', [GenreController::class, 'delete'])->name('delete');
});
