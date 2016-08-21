<?php

namespace Josercl\Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'Admin');

        $this->publishes([
            __DIR__ . '/../views' => resource_path('views/vendor/Admin')
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Admin',function($app){
            return new AdminBuilder($app['url'],$app['view']);
        });

        $this->app->alias('Admin', 'Josercl\Admin\AdminBuilder');
    }
}
