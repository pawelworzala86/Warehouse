<?php

namespace App\Container;

use App\Container;
use App\Type\UUID;

class FileResponse extends Container
{
    private $name;
    private $type;
    private $url;
    private $id;
    private $size;

    function setSize(int $size = null): FileResponse
    {
        $this->size = $size;
        return $this;
    }

    function getSize(): ?int
    {
        return $this->size;
    }

    function setId(UUID $id): FileResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }

    function setName(string $name): FileResponse
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }

    function setType(string $type): FileResponse
    {
        $this->type = $type;
        return $this;
    }

    function getType(): string
    {
        return $this->type;
    }

    function setUrl(string $url): FileResponse
    {
        $this->url = $url;
        return $this;
    }

    function getUrl(): string
    {
        return $this->url;
    }
}