<?php

namespace App\Module\Document\Request;

use App\Request\UserRequest;
use App\Type\SKU;

class CreateDocumentRequest extends UserRequest
{
    public $name;
    private $contractorId;

    public function getContractorId(): string
    {
        return $this->contractorId;
    }

    public function setContractorId(string $contractorId): CreateDocumentRequest
    {
        $this->contractorId = $contractorId;
        return $this;
    }

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