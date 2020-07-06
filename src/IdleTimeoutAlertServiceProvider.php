<?php

namespace Vectorwyse\IdleTimeoutAlert;

use Illuminate\Support\ServiceProvider;

class IdleTimeoutAlertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->publishes([
            __DIR__.'/../resources/assets' => resource_path('assets/vendor/vectorwyse/idle-timeout-alert')
        ], 'vue-components');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
