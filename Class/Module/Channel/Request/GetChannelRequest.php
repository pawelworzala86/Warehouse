<?php

namespace App\Module\Channel\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class GetChannelRequest extends UserRequest
{
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
}