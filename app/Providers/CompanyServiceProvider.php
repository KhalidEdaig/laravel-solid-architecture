<?php

namespace App\Providers;

use App\Contracts\CompanyContract;
use App\Http\Company\CompanyService;
use Illuminate\Support\ServiceProvider;

class CompanyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CompanyContract::class,CompanyService::class);
    }
}
