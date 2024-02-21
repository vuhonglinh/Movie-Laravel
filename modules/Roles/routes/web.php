<?php

use Illuminate\Support\Facades\Route;
use Modules\Roles\src\Http\Controllers\RoleController;
use Modules\Roles\src\Models\Role;

Route::middleware(['can:roles', 'auth'])->prefix('admin/roles')->name('admin.roles.')->group(function () {
       Route::get('/', [RoleController::class, 'index'])->name('index');
       Route::get('/data', [RoleController::class, 'data'])->name('data');

       Route::get('/add', [RoleController::class, 'add'])->name('add')->can('roles.add', Role::class);
       Route::post('/add', [RoleController::class, 'create'])->name('create')->can('roles.add', Role::class);

       Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit')->can('roles.edit', Role::class);
       Route::post('/edit/{id}', [RoleController::class, 'update'])->name('update')->can('roles.edit', Role::class);

       Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('delete')->can('roles.delete', Role::class);


       Route::get('/permissions/{id}', [RoleController::class, 'permissions'])->name('permissions')->can('roles.permissions');
       Route::post('/permissions/{id}', [RoleController::class, 'postPermissions'])->can('roles.permissions');
});
