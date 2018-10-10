<?php

namespace App\Module\Contractor\Response;

use App\Response\Response;
use App\Type\UUID;

class CreateContractorResponse extends Response
{

    public $id;

    function setId(UUID $id): CreateContractorResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}