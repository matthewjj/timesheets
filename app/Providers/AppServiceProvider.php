<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\TimesheetRepositoryInterface;
use App\Repositories\TimesheetRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(TimesheetRepositoryInterface::class, TimesheetRepository::class);
    }
}
