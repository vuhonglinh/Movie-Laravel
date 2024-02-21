<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\src\Http\Controllers\UserController;

Route::middleware(['can:users', 'auth'])->prefix('admin/users')->name('admin.users.')->group(function () {
       Route::get('/', [UserController::class, 'index'])->name('index');
       Route::get('/data', [UserController::class, 'data'])->name('data');

       Route::get('/add', [UserController::class, 'add'])->name('add');
       Route::post('/add', [UserController::class, 'create'])->name('create');

       Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
       Route::post('/edit/{id}', [UserController::class, 'update'])->name('update');

       Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
});
