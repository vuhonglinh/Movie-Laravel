<?php

use Illuminate\Support\Facades\Route;
use Modules\Categories\src\Http\Controllers\ApiCategoryController;
use Modules\Categories\src\Models\Category;

Route::prefix('api/admin/categories')->name('api.admin.categories.')->group(function () {
       Route::get('/', [ApiCategoryController::class, 'index'])->name('index');

       Route::post('/', [ApiCategoryController::class, 'create'])->name('create');

       Route::get('/{id}', [ApiCategoryController::class, 'detail'])->name('detail');

       Route::put('/{id}', [ApiCategoryController::class, 'update'])->name('update.put');
       Route::patch('/{id}', [ApiCategoryController::class, 'update'])->name('update.patch');

       Route::delete('/{id}', [ApiCategoryController::class, 'delete'])->name('delete');
});
