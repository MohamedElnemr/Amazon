<?php

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class UserServiceProvider extends ServiceProvider
{

    protected $namespace = "Modules\User\http\controllers";
    protected $webRoute = "app/Modules/User/Route/web.php";
    protected $apiRoute = "app/Modules/User/Route/api.php";


    public function boot()
    {

        $this->registerWebRoute();
        $this->registerApiRoute();
        $this->registerMigrations();
        $this->registerViews();

    }

    protected function registerWebRoute(){

        Route::middleware('web')
        ->namespace($this->namespace)
        ->group(base_path($this->webRoute));
    }

    protected function registerApiRoute(){
        Route::prefix('api')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path($this->apiRoute));

    }

    protected function registerMigrations(){

        $this->loadMigrationsFrom(__DIR__ . "/../../database/migrations");
    }

    protected function registerViews(){

        $this->loadViewsFrom(__DIR__ . "/../../views" , 'User');
    }
}

