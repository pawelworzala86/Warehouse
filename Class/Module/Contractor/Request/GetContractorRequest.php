<?php

namespace App\Module\Contractor\Request;

use App\Request\UserRequest;
use App\Type\SKU;
use App\Type\UUID;

class GetContractorRequest extends UserRequest
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