<?php

namespace App\Module\Financial\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class DeleteFinancialRequest extends UserRequest
{
    private $id;

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id): DeleteFinancialRequest
    {
        $this->id = $id;
        return $this;
    }
}