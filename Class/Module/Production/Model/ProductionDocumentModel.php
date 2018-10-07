<?php

namespace App\Module\Production\Model;

use App\Model;
use App\Type\SKU;
use App\Type\UUID;

class ProductionDocumentModel extends Model
{
    private $id;
    private $uuid;
    private $deleted;
    private $addedBy;
    private $productionId;
    private $documentId;

    public function setDocumentId(int $documentId): ProductionDocumentModel
    {
        $this->set('document_id', $documentId);
        $this->documentId = $documentId;
        return $this;
    }

    public function getDocumentId(): int
    {
        return $this->documentId;
    }

    public function setProductionId(int $productionId): ProductionDocumentModel
    {
        $this->set('production_id', $productionId);
        $this->productionId = $productionId;
        return $this;
    }

    public function getProductionId(): int
    {
        return $this->productionId;
    }

    public function setDeleted(int $deleted): ProductionDocumentModel
    {
        $this->set('deleted', $deleted);
        $this->deleted = $deleted;
        return $this;
    }
    
    public function getAddedBy(): int
    {
        return $this->addedBy;
    }

    public function setAddedBy(int $addedBy): ProductionDocumentModel
    {
        $this->set('added_by', $addedBy);
        $this->addedBy = $addedBy;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ProductionDocumentModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): ProductionDocumentModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}