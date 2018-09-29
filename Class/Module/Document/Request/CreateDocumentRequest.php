<?php

namespace App\Module\Document\Request;

use App\Request\UserRequest;
use App\Type\SKU;

class CreateDocumentRequest extends UserRequest
{
    public $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }
}