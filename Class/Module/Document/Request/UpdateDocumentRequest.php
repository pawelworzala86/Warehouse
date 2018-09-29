<?php

namespace App\Module\Document\Request;

use App\Request\UserRequest;
use App\Type\SKU;
use App\Type\UUID;

class UpdateDocumentRequest extends UserRequest
{
    public $name;
    public $id;
    private $contractorId;

    public function getContractorId(): string
    {
        return $this->contractorId;
    }

    public function setContractorId(string $contractorId): UpdateDocumentRequest
    {
        $this->contractorId = $contractorId;
        return $this;
    }

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id)
    {
        $this->id = $id;
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