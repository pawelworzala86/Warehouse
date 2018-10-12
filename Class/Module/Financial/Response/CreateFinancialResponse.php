<?php

namespace App\Module\Financial\Response;

use App\Response\Response;
use App\Type\UUID;

class CreateFinancialResponse extends Response
{
    private $id;

    function setId(UUID $id): CreateFinancialResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}