<?php

use Illuminate\Support\Facades\Route;
use Modules\Movies\src\Http\Controllers\ApiMovieController;

Route::apiResource('/api/admin/movies', ApiMovieController::class);
