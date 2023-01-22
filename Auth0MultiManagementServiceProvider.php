<?php

namespace Lanos\Auth0MultiManagement;

use Illuminate\Support\ServiceProvider;

/**
 * Service provider for the package.
 *
 * @package Lanos\CashierConnect\Providers
 */
class Auth0MultiManagementServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/authz.php', 'authz'
        );
    }

    /**
     * Register the package's config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $this->publishes([
            __DIR__.'/../config/authz.php' => config_path('authz.php'),
        ]);
    }

}
