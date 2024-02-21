<?php

use Illuminate\Support\Facades\Route;
use Modules\MucLuc\src\Http\Controllers\MucLucController;

Route::name('mucluc.')->group(function () {
     Route::get('danh-muc/{category}', [MucLucController::class, 'categories'])->name('categories');
     Route::get('the-loai/{genre}', [MucLucController::class, 'genres'])->name('genres');
     Route::get('quoc-gia/{country}', [MucLucController::class, 'countries'])->name('countries');
});
