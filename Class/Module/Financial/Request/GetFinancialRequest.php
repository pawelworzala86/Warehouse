<?php

namespace App\Module\Financial\Request;

use App\Request\UserRequest;
use App\Container\DocumentProducts;
use App\Type\UUID;

class GetFinancialRequest extends UserRequest
{
    private $id;

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id): GetFinancialRequest
    {
        $this->id = $id;
        return $this;
    }
}