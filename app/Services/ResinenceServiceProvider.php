<?php
namespace App\Services;

use Illuminate\Support\ServiceProvider;

class ResinenceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('Resinence', function($app) {
            return new Resinence();
        });
    }
}