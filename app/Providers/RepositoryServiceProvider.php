<?php

namespace App\Providers;

use App\Interfaces\ClinicProfileInterface;
use App\Repositories\ClinicProfileRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ClinicProfileInterface::class, ClinicProfileRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
