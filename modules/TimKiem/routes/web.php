<?php

use Illuminate\Support\Facades\Route;
use Modules\TimKiem\src\Http\Controllers\TimKiemController;

Route::prefix('tim-kiem')->name('timkiem.')->group(function () {
       Route::get('/', [TimKiemController::class, 'index'])->name('index');
});
