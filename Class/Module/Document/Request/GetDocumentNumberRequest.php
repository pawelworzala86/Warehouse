<?php

namespace App\Module\Document\Request;

use App\Request\UserRequest;
use App\Type\SKU;
use App\Type\UUID;

class GetDocumentNumberRequest extends UserRequest
{
    public $type;

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }
}