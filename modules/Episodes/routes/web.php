<?php

use Illuminate\Support\Facades\Route;
use Modules\Episodes\src\Http\Controllers\EpisodeController;

Route::prefix('admin/episodes')->name('admin.episodes.')->group(function () {
       Route::get('/{movie}', [EpisodeController::class, 'index'])->name('index');
       Route::get('/{movie}/data', [EpisodeController::class, 'data'])->name('data');

       Route::get('/{movie}/add', [EpisodeController::class, 'add'])->name('add');
       Route::post('/{movie}/add', [EpisodeController::class, 'create'])->name('create');

       Route::get('/edit/{id}', [EpisodeController::class, 'edit'])->name('edit');
       Route::post('/edit/{id}', [EpisodeController::class, 'update'])->name('update');

       Route::get('/delete/{id}', [EpisodeController::class, 'delete'])->name('delete');
});
