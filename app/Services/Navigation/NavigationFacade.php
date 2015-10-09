<?php

namespace App\Services\Navigation;

use Illuminate\Support\Facades\Facade;

/**
 * @see \app\Http\Navigation\Navigation
 */
class NavigationFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'navigation';
    }
}
