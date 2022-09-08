<?php

namespace Modules\Driver\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class DriverServiceProvider extends ServiceProvider
{
    protected $vendorNamspass = "Modules\Driver\Http\Controllers";
    protected $apiRoute       = "Modules\Driver\Routes\api.php";
    protected $webRoute       = "Modules\Driver\Routes\web.php";

    public function boot()
    {
        $this->registerRoutes();
        $this->registerApiRoutes();
        $this->registerMigrations();
        $this->registerViews();
    }

    protected function registerRoutes()
    {
        Route::prefix('site')
             ->middleware('web')
             ->namespace($this->vendorNamspass)
             ->group(base_path($this->webRoute));
    }

    protected function registerApiRoutes()
    {
        Route::prefix('admin')
             ->middleware('api')
             ->namespace($this->vendorNamspass)
             ->group(base_path($this->apiRoute));
    }

    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../Database/migrations');
    }

    protected function registerViews()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../Views','Driver');
    }
}
