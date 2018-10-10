<?php

namespace App;

class Enum extends Type
{
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}