<?php

namespace App\Type;

use App\Type;

class Error extends Type
{
    private $error;

    public function __construct($datas = null)
    {
        parent::__construct($datas);
        if (!isset($datas) || (!is_string($datas) && !isset($this->uuid))) {
            throw new \Exception('ID must have a value!');
        } else if(is_string($datas)){
            $this->setError($datas);
        }
    }

    function setError(string $error): Error
    {
        $this->error = $error;
        return $this;
    }

    function getError(): string
    {
        return $this->error;
    }

}