<?php

namespace App\Module\Integration\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class AllegroSendRequest extends UserRequest
{
    private $id;

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