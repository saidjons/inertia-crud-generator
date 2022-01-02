<?php

namespace Saidjon\InertiaCrudGenerator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Saidjon\InertiaCrudGenerator\InertiaCrudGenerator
 */
class InertiaCrudGenerator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'inertia-crud-generator';
    }
}
