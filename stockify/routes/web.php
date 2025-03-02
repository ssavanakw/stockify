<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\StockTransactionController;

use App\Http\Middleware\IsLogin;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'loginView']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::get('/', [DashboardController::class, 'index']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm']);
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(IsLogin::class)->group(function () {

// Reports Management
    Route::prefix('reports')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/create', [ReportController::class, 'create'])->name('reports.create');
        Route::post('/', [ReportController::class, 'store'])->name('reports.store');
        Route::get('/{id}/edit', [ReportController::class, 'edit'])->name('reports.edit');
        Route::put('/{id}', [ReportController::class, 'update'])->name('reports.update');
        Route::delete('/{id}', [ReportController::class, 'delete'])->name('reports.delete');
    });

    // Materials Routes
    Route::get('/materials', [MaterialController::class, 'index']);
    Route::get('/materials/create', [MaterialController::class, 'create']);
    Route::get('/materials/edit/{id}', [MaterialController::class, 'edit']);
    Route::post('/materials/store', [MaterialController::class, 'store']);
    Route::put('/materials/{id}', [MaterialController::class, 'update']);
    Route::delete('/materials/{id}', [MaterialController::class, 'delete']);

    // Categories Routes
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('/categories/store', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'delete']);

    // 🔴 User Management - Only for Admins
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('suppliers', SupplierController::class);

        Route::put('/users/{id}/change-password', [UserController::class, 'updatePassword'])->name('users.updatePassword');
    });

    // Task Management - Only for Admin & Manager
    Route::middleware(['role:admin,manager'])->group(function () {
        Route::post('/tasks/assign', [TaskController::class, 'assignTask'])
            ->name('tasks.assign');
    });

    Route::middleware(['auth'])->group(function () {
        Route::put('/tasks/{id}/complete', [TaskController::class, 'markAsComplete'])->name('tasks.complete');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    });

    // ✅ Suppliers Routes (Dimodifikasi)
    Route::prefix('suppliers')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('suppliers.index');
        Route::get('/create', [SupplierController::class, 'create'])->name('suppliers.create');
        Route::post('/store', [SupplierController::class, 'store'])->name('suppliers.store');
        Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
        Route::put('/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
        Route::delete('/{id}', [SupplierController::class, 'delete'])->name('suppliers.delete');
    });

    Route::resource('stock-transactions', StockTransactionController::class);

});


    // Route::middleware(IsLogin::class)
// ->group(
//     function()
//     {
//         Route::get('/', [DashboardController::class, 'index']);

//         Route::get('/materials', [MaterialController::class, 'index']);
//         Route::get('/materials/create', [MaterialController::class, 'create']);
//         Route::get('/materials/edit/{id}', [MaterialController::class, 'edit']);
//         Route::post('/materials/store', [MaterialController::class, 'store']);
//         Route::put('/materials/{id}', [MaterialController::class, 'update']);
//         Route::delete('/materials/{id}', [MaterialController::class, 'delete']);

//         Route::get('/categories', [CategoryController::class, 'index']);
//         Route::get('/categories/create', [CategoryController::class, 'create']);
//         Route::get('/categories/edit/{id}', [CategoryController::class, 'edit']);
//         Route::post('/categories/store', [CategoryController::class, 'store']);
//         Route::put('/categories/{id}', [CategoryController::class, 'update']);
//         Route::delete('/categories/{id}', [CategoryController::class, 'delete']);

//     });


