<?php

use Illuminate\Support\Facades\Route;
use Modules\Movies\src\Http\Controllers\MovieController;

Route::middleware(['can:movies', 'auth'])->prefix('admin/movies')->name('admin.movies.')->group(function () {
       Route::get('/', [MovieController::class, 'index'])->name('index');
       Route::get('/data', [MovieController::class, 'data'])->name('data');

       Route::get('/add', [MovieController::class, 'add'])->name('add')->can('movies.add');
       Route::post('/add', [MovieController::class, 'create'])->name('create')->can('movies.add');

       Route::get('/edit/{id}', [MovieController::class, 'edit'])->name('edit')->can('movies.edit');
       Route::post('/edit/{id}', [MovieController::class, 'update'])->name('update')->can('movies.edit');

       Route::get('/delete/{id}', [MovieController::class, 'delete'])->name('delete')->can('movies.delete');
});
