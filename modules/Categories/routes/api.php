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


// Xây dựng CRUD API

// GET: /users => Lấy tất cả tài nguyên

// GET: /users/id => Lấy 1 tài nguyên theo id

// POST: /users => Thêm mới tài nguyên 

// PUT: /users/id => Cập nhật tất cả các trường của tài nguyên

// PATCH: /users/id => Cập nhật 1 vài trường của tài nguyên

// DELETE: /users/id => Xóa 1 tài nguyên