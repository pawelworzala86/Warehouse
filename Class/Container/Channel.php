<?php

namespace App\Container;

use App\Container;
use App\Type\UUID;

class Channel extends Container
{
    private $id;
    private $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Channel
    {
        $this->name = $name;
        return $this;
    }

    function setId(UUID $id): Channel
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}