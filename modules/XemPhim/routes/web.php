<?php

use Illuminate\Support\Facades\Route;
use Modules\Movies\src\Models\Movie;
use Modules\XemPhim\src\Http\Controllers\XemPhimController;

Route::middleware('auth:customer')->prefix('xem-phim')->name('xemphim.')->group(function () {
       Route::get('/{movie}', [XemPhimController::class, 'index'])->name('index');

       Route::get('/{movie}/{episode}', [XemPhimController::class, 'episode'])->name('episode');

       Route::post('/add/{movie}', [XemPhimController::class, 'add'])->name('add')->middleware('auth:customer');

       Route::post('/reviews/{movie}', [XemPhimController::class, 'reviews'])->name('reviews')->middleware('auth:customer');

       Route::post('/view/{movie}', [XemPhimController::class, 'addView'])->name('addView');
});
