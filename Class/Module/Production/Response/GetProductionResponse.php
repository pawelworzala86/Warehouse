<?php

namespace App\Module\Production\Response;

use App\Response\Response;
use App\Type\UUID;

class GetProductionResponse extends Response
{
    private $id;
    private $name;

    function setName(string $name = null): GetProductionResponse
    {
        $this->name = $name;
        return $this;
    }

    function getName(): ?string
    {
        return $this->name;
    }


    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id): GetProductionResponse
    {
        $this->id = $id;
        return $this;
    }
}