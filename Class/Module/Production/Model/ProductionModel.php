<?php

namespace App\Module\Production\Model;

use App\Model;
use App\Type\SKU;
use App\Type\UUID;

class ProductionModel extends Model
{
    private $id;
    private $uuid;
    private $name;
    private $deleted;
    private $addedBy;

    function setName(string $name = null): ProductionModel
    {
        $this->set('name', $name);
        $this->name = $name;
        return $this;
    }

    function getName(): ?string
    {
        return $this->name;
    }

    public function getDeleted(): int
    {
        return $this->deleted;
    }
    public function setDeleted(int $deleted): ProductionModel
    {
        $this->set('deleted', $deleted);
        $this->deleted = $deleted;
        return $this;
    }
    
    public function getAddedBy(): int
    {
        return $this->addedBy;
    }

    public function setAddedBy(int $addedBy): ProductionModel
    {
        $this->set('added_by', $addedBy);
        $this->addedBy = $addedBy;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ProductionModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): ProductionModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}