<?php

namespace App\Module\Channel\Response;

use App\Response\Response;
use App\Type\UUID;

class CreateChannelResponse extends Response
{
    public $id;

    function setId(UUID $id): CreateChannelResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}