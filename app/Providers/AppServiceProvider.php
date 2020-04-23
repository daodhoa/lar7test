<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        //
    }
}
