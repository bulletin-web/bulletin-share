<?php namespace Backend\Facades;

use October\Rain\Support\Facade;

class BackendBackup extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * Resolves to:
     * - Backend\Classes\AuthManager
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'backend.backup';
    }
}
