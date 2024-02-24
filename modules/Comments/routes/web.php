<?php

use Illuminate\Support\Facades\Route;
use Modules\Comments\src\Http\Controllers\CommentController;

Route::middleware('can:comments')->prefix('admin/comments')->name('admin.comments.')->group(function () {
       Route::get('/{movie}', [CommentController::class, 'index'])->name('index');
       
       Route::get('/{movie}/data', [CommentController::class, 'data'])->name('data');

       Route::get('/delete/{id}', [CommentController::class, 'delete'])->name('delete');
});
