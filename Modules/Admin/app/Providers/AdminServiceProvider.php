<?php

namespace Module\Admin\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
// use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{

    protected $moduleNamespace = 'Module\Admin\Http\Controllers';
    protected $webRoute = 'Modules/Admin/routes/site.php';
    protected $apiRoute = 'Modules/Admin/routes/admin.php';


    public function boot()
    {
        $this->rejesterRoutes();
        $this->rejesterApiRoutes();
        $this->regesterMigrations();
        $this->regesterViews();
    }

    protected function rejesterRoutes()
    {
        Route::middleware('site')
            ->namespace($this->moduleNamespace)
            ->group(base_path($this->webRoute));
    }


    protected function rejesterApiRoutes()
    {
        Route::prefix('admin')
            ->namespace($this->moduleNamespace)
            ->group(base_path($this->apiRoute));
    }


    protected function regesterMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../Database/Migrations');
    }

    protected function regesterViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../../Views', 'Admin');
    }
}
