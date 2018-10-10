<?php

namespace App\Module\Cash\Response;

use App\Response\Response;
use App\Type\UUID;

class CreateCashResponse extends Response
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