<?php

namespace App\Module\Channel\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class CreateChannelRequest extends UserRequest
{

    public $name;
    public $host;
    public $key;

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key)
    {
        $this->key = $key;
        return $this;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function setHost(string $host)
    {
        $this->host = $host;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }
}