<?php

namespace TuxDaemon\LaravelSimpleLdap;

use Illuminate\Support\ServiceProvider;
use TuxDaemon\LaravelSimpleLdap\Services\Contracts\LdapService;
use TuxDaemon\LaravelSimpleLdap\Services\LaravelSimpleLdap;

class LaravelSimpleLdapServiceProvider extends ServiceProvider
{
    /**
    * Publishes configuration file.
    *
    * @return  void
    */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravel_simple_ldap.php' => config_path('laravel_simple_ldap.php'),
        ], 'laravel-simple-ldap-config');
    }

    /**
    * Make config publishment optional by merging the config from the package.
    *
    * @return  void
    */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel_simple_ldap.php',
            'laravel_simple_ldap'
        );

        $this->app->singleton(LdapService::class, function () {
            return new LaravelSimpleLdap;
        });
    }
}
