<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Auth::routes(['register' => false]);
//Route::get('/', [LoginController::class, 'showLoginForm']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');

    Route::prefix('/invoices')->name('invoices.')->middleware(['can:invoices'])->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('index');
        Route::get('/create', [InvoiceController::class, 'create'])->name('create');
        Route::post('/', [InvoiceController::class, 'store'])->name('store');
        Route::get('/{id}/show', [InvoiceController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [InvoiceController::class, 'edit'])->name('edit');
        Route::post('/{id}', [InvoiceController::class, 'update'])->name('update');
        Route::delete('/{id}', [InvoiceController::class, 'destroy'])->name('destroy');

        Route::get('/payment/{id}/edit', [InvoiceController::class, 'edit_payment'])->name('edit.payment');
        Route::post('/payment/{id}', [InvoiceController::class, 'update_payment'])->name('update.payment');

        Route::get('/archive/{id}', [InvoiceController::class, 'archive'])->name('destroy.archive');

        Route::get('/paid', [InvoiceController::class, 'invoice_paid'])->name('paid');
        Route::get('/unpaid', [InvoiceController::class, 'invoice_unpaid'])->name('unpaid');
        Route::get('/partial', [InvoiceController::class, 'invoice_partial'])->name('partial');

        Route::get('/print/{id}', [InvoiceController::class, 'print'])->name('print');

    });
    Route::prefix('/invoices/archive')->name('invoices.')->middleware(['can:invoices-archive'])->group(function () {

        Route::get('/', [ArchiveController::class, 'index'])->name('archive');
        Route::get('/{id}/edit', [ArchiveController::class, 'update'])->name('update.archive');
        Route::delete('/{id}', [ArchiveController::class, 'destroy'])->name('force.destroy.archive');

    });
    Route::prefix('/reports')->name('reports.')->middleware(['can:reports'])->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::post('/', [ReportController::class, 'search'])->name('search');
    });

    Route::prefix('/sections')->name('sections.')->group(function () {
        Route::get('/', [SectionController::class, 'index'])->name('index');
        Route::get('/create', [SectionController::class, 'create'])->name('create');
        Route::post('/store', [SectionController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SectionController::class, 'edit'])->name('edit');
        Route::post('/{id}', [SectionController::class, 'update'])->name('update');
        Route::delete('/{id}', [SectionController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::post('/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/users')->name('users.')->middleware(['can:users'])->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('/{id}', [UserController::class, 'update'])->name('update');
        Route::get('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/roles')->name('roles.')->middleware('can:roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::post('/{id}', [RoleController::class, 'update'])->name('update');
        Route::get('/{id}', [RoleController::class, 'destroy'])->name('destroy');
    });
});

