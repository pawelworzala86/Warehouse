<?php

namespace App\Module\Channel\Response;

use App\Response\Response;
use App\Type\UUID;

class GetChannelResponse extends Response
{
    private $id;
    private $name;
    public $host;
    public $key;

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): GetChannelResponse
    {
        $this->key = $key;
        return $this;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function setHost(string $host): GetChannelResponse
    {
        $this->host = $host;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): GetChannelResponse
    {
        $this->name = $name;
        return $this;
    }

    function setId(UUID $id): GetChannelResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}