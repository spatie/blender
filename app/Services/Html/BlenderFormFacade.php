<?php

namespace App\Services\Html;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\Html\BlenderFormBuilder
 */
class BlenderFormFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return BlenderFormBuilder::class;
    }
}
