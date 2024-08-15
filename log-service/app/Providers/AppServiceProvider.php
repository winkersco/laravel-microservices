<?php

namespace App\Providers;

use App\Repositories\LogRepository;
use App\Repositories\LogRepositoryInterface;
use App\Support\ResponseFormatter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LogRepositoryInterface::class, LogRepository::class);

        $this->app->singleton('responseformatter', function () {
            return new ResponseFormatter();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
