<?php

namespace App\Module\Production\Response;

use App\Response\Response;
use App\Type\UUID;

class CreateProductionResponse extends Response
{
    private $id;

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id): CreateProductionResponse
    {
        $this->id = $id;
        return $this;
    }
}