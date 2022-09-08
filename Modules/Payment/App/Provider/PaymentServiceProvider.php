<?php
namespace Modules\Payment\Provider;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;


class PaymentServiceProvider extends ServiceProvider
{


    protected $moduleNamespace = 'Modules\Payment\Http\Controller';
    protected $webRoute = 'Modules\Payment\Route\web.php';
    protected $ApiRoute = 'Modules\Payment\Route\api.php';


    public function boot()
    {
        $this->registerRoutes();
        $this->registerApiRoutes();
        $this->registerViews();
        $this->registerMigrations();
    }
    /**
     * Register Routes
     **/
    protected function registerRoutes()
    {
        Route::prefix('web')
            ->namespace($this->moduleNamespace)
            ->group(base_path($this->webRoute));
    }
    /**
     * Register ApiRoutes
     **/
    protected function registerApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(base_path($this->ApiRoute));
    }

    /**
     * Register Module Migration and Views
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../Views', 'Payment');
    }



}
