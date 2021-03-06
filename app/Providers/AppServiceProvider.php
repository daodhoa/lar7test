<?php

namespace App\Providers;

use App\View\Components\NavBarAdmin;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
   
    public function register()
    {
        $dataAdmin = [
            'AuthService'
        ];

        foreach ($dataAdmin as $name) {
            $this->app->bind('App\Services\Admin\\'.$name.'Interface', 'App\Services\Admin\\'.$name);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::defaultStringLength(191);
        Blade::component('nav-bar-admin', NavBarAdmin::class);
    }
}
