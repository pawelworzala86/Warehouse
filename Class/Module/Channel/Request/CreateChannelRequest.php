<?php

namespace App\Module\Channel\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class CreateChannelRequest extends UserRequest
{

    public $name;

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