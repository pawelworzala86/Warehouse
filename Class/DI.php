<?php

namespace App;

use ReflectionClass;

class DI
{

    //static private $classes;

    static public function get(string $className)
    {
        return new ReflectionClass($className);
    }

}
