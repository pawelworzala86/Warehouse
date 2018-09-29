<?php

namespace App\Type;

use App\Type;

class Document extends Type
{
    private $id;

    function setId(UUID $id): Document
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}