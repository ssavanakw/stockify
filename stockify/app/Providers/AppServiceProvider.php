<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Supplier;
use App\Policies\SupplierPolicy;
use App\Repositories\AuthRepository;
use App\Repositories\AuthRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\MaterialRepository;
use App\Repositories\MaterialRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\DashboardRepository;
use App\Repositories\DashboardRepositoryInterface;
use App\Repositories\RegisterRepository;
use App\Repositories\RegisterRepositoryInterface;
use App\Repositories\ReportRepository;
use App\Repositories\ReportRepositoryInterface;
use App\Repositories\StockTransactionRepository;
use App\Repositories\StockTransactionRepositoryInterface;
use App\Repositories\SupplierRepository;
use App\Repositories\SupplierRepositoryInterface;
use App\Repositories\TaskRepository;
use App\Repositories\TaskRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\AuthService;
use App\Services\CategoryService;
use App\Services\DashboardService;
use App\Services\MaterialService;
use App\Services\RegisterService;
use App\Services\ReportService;
use App\Services\StockTransactionService;
use App\Services\SupplierService;
use App\Services\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MaterialRepositoryInterface::class, MaterialRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(StockTransactionRepositoryInterface::class, StockTransactionRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);
        $this->app->bind(RegisterRepositoryInterface::class, RegisterRepository::class);
        


        $this->app->singleton(SupplierRepository::class, function ($app) {
            return new SupplierRepository();
        });

        $this->app->singleton(SupplierService::class, function ($app) {
            return new SupplierService($app->make(SupplierRepository::class));
        });

        $this->app->singleton(StockTransactionRepository::class, function ($app) {
            return new StockTransactionRepository();
        });

        $this->app->singleton(StockTransactionService::class, function ($app) {
            return new StockTransactionService($app->make(StockTransactionRepository::class));
        });

        $this->app->singleton(DashboardRepository::class, function ($app) {
            return new DashboardRepository();
        });

        $this->app->singleton(DashboardService::class, function ($app) {
            return new DashboardService($app->make(DashboardRepository::class));
        });

        $this->app->singleton(AuthRepository::class, function ($app) {
            return new AuthRepository();
        });

        $this->app->singleton(AuthService::class, function ($app) {
            return new AuthService($app->make(AuthRepository::class));
        });

        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository();
        });

        $this->app->singleton(UserService::class, function ($app) {
            return new UserService($app->make(UserRepository::class));
        });

        $this->app->singleton(ReportRepository::class, function ($app) {
            return new ReportRepository();
        });

        $this->app->singleton(ReportService::class, function ($app) {
            return new ReportService($app->make(ReportRepository::class));
        });

        $this->app->singleton(RegisterRepository::class, function ($app) {
            return new RegisterRepository();
        });

        $this->app->singleton(RegisterService::class, function ($app) {
            return new RegisterService($app->make(RegisterRepository::class));
        });

        $this->app->singleton(MaterialRepository::class, function ($app) {
            return new MaterialRepository();
        });

        $this->app->singleton(MaterialService::class, function ($app) {
            return new MaterialService($app->make(MaterialRepository::class));
        });

        $this->app->singleton(CategoryRepository::class, function ($app) {
            return new CategoryRepository();
        });

        $this->app->singleton(CategoryService::class, function ($app) {
            return new CategoryService($app->make(CategoryRepository::class));
        });


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Supplier::class, SupplierPolicy::class);
    }
}
