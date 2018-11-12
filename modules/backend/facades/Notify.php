<?php namespace Backend\Facades;

use October\Rain\Support\Facade;

class Notify extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * Resolves to:
     * - Backend\Classes\Notify
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'backend.notify';
    }
}
