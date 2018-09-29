<?php

namespace App\Module\Contractor\Model;

use App\Model;
use App\Type\UUID;

class ContractorModel extends Model
{
    private $id;
    private $uuid;
    private $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ContractorModel
    {
        $this->set('name', $name);
        $this->name = $name;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ContractorModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): ContractorModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}