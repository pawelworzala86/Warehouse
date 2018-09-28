<?php

namespace App\Type;

use App\Type;

class Enum extends Type
{
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}