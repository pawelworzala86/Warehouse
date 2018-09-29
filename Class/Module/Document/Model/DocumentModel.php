<?php

namespace App\Module\Document\Model;

use App\Model;
use App\Type\UUID;

class DocumentModel extends Model
{
    private $id;
    private $uuid;
    private $name;
    private $contractorId;
    private $date;
    private $description;
    private $net;
    private $tax;
    private $gross;

    public function getGross(): ?float
    {
        return $this->gross;
    }

    public function setGross(float $gross = null): DocumentModel
    {
        $this->set('gross', $gross);
        $this->gross = $gross;
        return $this;
    }
    
    public function getTax(): ?float
    {
        return $this->tax;
    }

    public function setTax(float $tax = null): DocumentModel
    {
        $this->set('tax', $tax);
        $this->tax = $tax;
        return $this;
    }

    public function getNet(): ?float
    {
        return $this->net;
    }

    public function setNet(float $net = null): DocumentModel
    {
        $this->set('net', $net);
        $this->net = $net;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description = null): DocumentModel
    {
        $this->set('description', $description);
        $this->description = $description;
        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date = null): DocumentModel
    {
        $this->set('date', $date);
        $this->date = $date;
        return $this;
    }

    public function getContractorId(): int
    {
        return $this->contractorId;
    }

    public function setContractorId(int $contractorId): DocumentModel
    {
        $this->set('contractor_id', $contractorId);
        $this->contractorId = $contractorId;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): DocumentModel
    {
        $this->set('name', $name);
        $this->name = $name;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): DocumentModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): DocumentModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}