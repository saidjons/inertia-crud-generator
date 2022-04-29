<?php

namespace Saidjon\InertiaCrudGenerator\Generator;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Saidjon\InertiaCrudGenerator\Traits\Replacor;


 class FieldFactory
{

    const FIELD_NAMESPACE = 'Saidjon\InertiaCrudGenerator\Fields\\';


     static public function getField($className,$data)
    {

        $namespace = self::FIELD_NAMESPACE.$className;
        try {
            $class = new $namespace($data);
            return $class->getData();
            
        } catch (\Throwable $th) {
            
            throw new \Exception("Field Class not Found. {$th->getMessage()}");
        }
        
    
    }

}