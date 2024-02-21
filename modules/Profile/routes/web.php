<?php

use Illuminate\Support\Facades\Route;
use Modules\Profile\src\Http\Controllers\ProfileController;

Route::middleware(['auth'])->prefix('admin/profile')->name('admin.profile.')->group(function () {
       Route::get('/', [ProfileController::class, 'index'])->name('index');
       
       Route::post('/change-info', [ProfileController::class, 'changeInfo'])->name('change.info');

       Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
});
