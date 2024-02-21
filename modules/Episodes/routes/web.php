<?php

use Illuminate\Support\Facades\Route;
use Modules\Episodes\src\Http\Controllers\EpisodeController;

Route::middleware(['auth'])->middleware('can:episodes')->prefix('admin/episodes')->name('admin.episodes.')->group(function () {
       Route::get('/{movie}', [EpisodeController::class, 'index'])->name('index');
       Route::get('/{movie}/data', [EpisodeController::class, 'data'])->name('data');

       Route::get('/{movie}/add', [EpisodeController::class, 'add'])->name('add')->can('episodes.add');
       Route::post('/{movie}/add', [EpisodeController::class, 'create'])->name('create')->can('episodes.add');

       Route::get('/edit/{id}', [EpisodeController::class, 'edit'])->name('edit')->can('episodes.edit');
       Route::post('/edit/{id}', [EpisodeController::class, 'update'])->name('update')->can('episodes.edit');

       Route::get('/delete/{id}', [EpisodeController::class, 'delete'])->name('delete')->can('episodes.delete');
});
