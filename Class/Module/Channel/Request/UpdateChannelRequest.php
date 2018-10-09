<?php

namespace App\Module\Channel\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class UpdateChannelRequest extends UserRequest
{

    public $name;
    public $id;

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id)
    {
        $this->id = $id;
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