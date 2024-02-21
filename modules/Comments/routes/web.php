<?php

use Illuminate\Support\Facades\Route;
use Modules\Comments\src\Http\Controllers\CommentController;

Route::middleware('can:comments')->prefix('admin/comments')->name('admin.comments.')->group(function () {
       Route::get('/{id}', [CommentController::class, 'index'])->name('index');
       Route::get('/data/{id}', [CommentController::class, 'data'])->name('data');
});
