<?php

use Illuminate\Support\Facades\Route;
use Modules\Customers\src\Http\Controllers\CustomerController;
use Modules\Customers\src\Models\Customer;

Route::middleware(['can:customers', 'auth'])->prefix('admin/customers')->name('admin.customers.')->group(function () {
       Route::get('/', [CustomerController::class, 'index'])->name('index');
       Route::get('/data', [CustomerController::class, 'data'])->name('data');

       Route::get('/add', [CustomerController::class, 'add'])->name('add')->can('customers.add', Customer::class);
       Route::post('/add', [CustomerController::class, 'create'])->name('create')->can('customers.add', Customer::class);

       Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit')->can('customers.edit', Customer::class);
       Route::post('/edit/{id}', [CustomerController::class, 'update'])->name('update')->can('customers.edit', Customer::class);

       Route::get('/delete/{id}', [CustomerController::class, 'delete'])->name('delete')->can('customers.delete', Customer::class);
});
