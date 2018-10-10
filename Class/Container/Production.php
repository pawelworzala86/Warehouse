<?php

namespace App\Container;

use App\Container;
use App\Type\UUID;

class Production extends Container
{
    private $id;
    private $name;
    private $buyNet;
    private $sellNet;

    function setSellNet(float $sellNet = null): Production
    {
        $this->sellNet = $sellNet;
        return $this;
    }

    function getSellNet(): ?float
    {
        return $this->sellNet;
    }

    function setBuyNet(float $buyNet = null): Production
    {
        $this->buyNet = $buyNet;
        return $this;
    }

    function getBuyNet(): ?float
    {
        return $this->buyNet;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Production
    {
        $this->name = $name;
        return $this;
    }

    function setId(UUID $id): Production
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}