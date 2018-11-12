<?php namespace Backend\Facades;

use October\Rain\Support\Facade;

class PostProvider extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * Resolves to:
     * - Backend\Classes\PostProvider
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'backend.post';
    }
}
