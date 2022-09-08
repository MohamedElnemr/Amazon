<?php

namespace Modules\Vendor\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class VendorServiceProvider extends ServiceProvider
{
    protected $vendorNamspass = "Modules\Vendor\Controllers";
    protected $apiRoute       = "Modules\Vendor\Routes\api.php";
    protected $webRoute       = "Modules\Vendor\Routes\web.php";

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
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
    }

    protected function registerViews()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../Views','Vendor');
    }
}
