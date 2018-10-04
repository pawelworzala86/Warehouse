<?php

namespace App\Response;

use App\Type\UUID;

class XlsResponse extends Response
{
    private $id;
    private $url;
    private $name;

    function setName(string $name): XlsResponse
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }

    function setId(UUID $id): XlsResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }

    function setUrl(string $url): XlsResponse
    {
        $this->url = $url;
        return $this;
    }

    function getUrl(): string
    {
        return $this->url;
    }
}