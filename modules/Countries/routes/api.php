<?php

use Illuminate\Support\Facades\Route;
use Modules\Countries\src\Http\Controllers\ApiCountryController;

Route::apiResource('api/admin/countries', ApiCountryController::class);
