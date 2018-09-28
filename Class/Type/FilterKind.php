<?php

namespace App\Type;

use PHPMailer\PHPMailer\Exception;

class FilterKind extends Enum
{
    public $value;
    private $enum = ['=', '>', '<', 'null', '%'];

    function setValue(string $value): Filter
    {
        if(!in_array($value, $this->enum)){
            throw new Exception('Value of FilterKind='.$value.' not exists!');
        }
        $this->value = $value;
        return $this;
    }

    function getValue(): string
    {
        return $this->value;
    }
}