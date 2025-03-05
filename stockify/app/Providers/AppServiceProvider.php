<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Supplier;
use App\Policies\SupplierPolicy;
use Illuminate\Support\ServiceProvider;
use App\Repositories\MaterialRepository;
use App\Repositories\MaterialRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryInterface;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Supplier::class, SupplierPolicy::class);
    }
}
