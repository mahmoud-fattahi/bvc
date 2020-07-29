<?php

namespace ACME\HelloWorld\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * HelloWorld service provider
 *
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class HelloWorldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/../Http/routes.php';
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'helloworld');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }
}