<?php

namespace Snaptier\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the snaptier facade class.
 *
 * @author Miguel Piedrafita <soy@miguelpiedrafita.com>
 */
class Snaptier extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'snaptier';
    }
}
