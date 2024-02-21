<?php

use Illuminate\Support\Facades\Route;
use Modules\XemPhim\src\Http\Controllers\XemPhimController;

Route::prefix('xem-phim')->name('xemphim.')->group(function () {
       Route::get('/{movie}', [XemPhimController::class, 'index'])->name('index');
       Route::post('/add/{movie}', [XemPhimController::class, 'add'])->name('add')->middleware('auth:customer');
       Route::post('/reviews/{movie}', [XemPhimController::class, 'reviews'])->name('reviews')->middleware('auth:customer');
});
