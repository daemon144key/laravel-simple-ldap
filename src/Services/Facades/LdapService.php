<?php

namespace TuxDaemon\LaravelSimpleLdap\Services\Facades;

class LdapService extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'TuxDaemon\LaravelSimpleLdap\Services\Contracts\LdapService';
    }
}
