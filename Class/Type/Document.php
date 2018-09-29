<?php

namespace App\Type;

use App\Type;

class Document extends Type
{
    private $name;
    private $id;
    private $date;

    function setDate(string $date): Document
    {
        $this->date = $date;
        return $this;
    }

    function getDate(): string
    {
        return $this->date;
    }

    function setId(UUID $id): Document
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }

    function setName(string $name): Document
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }
}