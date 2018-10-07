<?php

namespace App\Module\Production\Model;

use App\Model;
use App\Type\SKU;
use App\Type\UUID;

class ProductionViewModel extends Model
{
    private $id;
    private $uuid;
    private $name;
    private $addedBy;
    private $buyNet;
    private $sellNet;

    function setSellNet(float $sellNet = null): ProductionViewModel
    {
        $this->set('sell_net', $sellNet);
        $this->sellNet = $sellNet;
        return $this;
    }

    function getSellNet(): ?float
    {
        return $this->sellNet;
    }

    function setBuyNet(float $buyNet = null): ProductionViewModel
    {
        $this->set('buy_net', $buyNet);
        $this->buyNet = $buyNet;
        return $this;
    }

    function getBuyNet(): ?float
    {
        return $this->buyNet;
    }

    function setName(string $name = null): ProductionViewModel
    {
        $this->set('name', $name);
        $this->name = $name;
        return $this;
    }

    function getName(): ?string
    {
        return $this->name;
    }
    
    public function getAddedBy(): int
    {
        return $this->addedBy;
    }

    public function setAddedBy(int $addedBy): ProductionViewModel
    {
        $this->set('added_by', $addedBy);
        $this->addedBy = $addedBy;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ProductionViewModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): ProductionViewModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}