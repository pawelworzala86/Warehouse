<?php

namespace App\Container;

use App\Container;
use App\Type\FilterKind;

class Filter extends Container
{
    private $name;
    private $kind;
    private $value;

    function setValue(string $value = null): Filter
    {
        $this->value = $value;
        return $this;
    }

    function getValue(): ?string
    {
        return $this->value;
    }

    function setKind(FilterKind $kind): Filter
    {
        $this->kind = $kind;
        return $this;
    }

    function getKind(): FilterKind
    {
        return $this->kind;
    }

    function setName(string $name): Filter
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }
}