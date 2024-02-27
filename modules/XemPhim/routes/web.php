<?php

use Illuminate\Support\Facades\Route;
use Modules\Movies\src\Models\Movie;
use Modules\XemPhim\src\Http\Controllers\XemPhimController;

Route::middleware(['auth:customer', 'verified'])->prefix('xem-phim')->name('xemphim.')->group(function () {
       Route::get('/{movie}', [XemPhimController::class, 'index'])->name('index');

       Route::get('/{movie}/{episode}', [XemPhimController::class, 'episode'])->name('episode');

       Route::post('/add/{movie}', [XemPhimController::class, 'add'])->name('add');

       Route::post('/reviews/{movie}', [XemPhimController::class, 'reviews'])->name('reviews');

       Route::post('/view/{movie}', [XemPhimController::class, 'addView'])->name('addView');
});
