<?php

use Illuminate\Support\Facades\Route;
use Modules\TrangChu\src\Http\Controllers\TrangChuController;

Route::prefix('trang-chu')->name('trangchu.')->group(function () {
       Route::get('/', [TrangChuController::class, 'index'])->name('index');
});
