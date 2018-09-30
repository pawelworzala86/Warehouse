<?php

namespace App\Module\Document\Model;

use App\Model;
use App\Type\UUID;

class DocumentViewModel extends Model
{
    private $id;
    private $uuid;
    private $name;
    private $date;
    private $addedBy;
    private $delete;
    private $contractorName;
    private $gross;
    private $contractorId;

    public function getContractorId(): ?UUID
    {
        return $this->contractorId;
    }

    public function setContractorId(UUID $contractorId = null): DocumentViewModel
    {
        $this->set('contractor_id', $contractorId);
        $this->contractorId = $contractorId;
        return $this;
    }

    public function getGross(): float
    {
        return $this->gross;
    }

    public function setGross(float $gross): DocumentViewModel
    {
        $this->set('gross', $gross);
        $this->gross = $gross;
        return $this;
    }

    public function getContractorName(): ?string
    {
        return $this->contractorName;
    }

    public function setContractorName(string $contractorName = null): DocumentViewModel
    {
        $this->set('contractor_name', $contractorName);
        $this->contractorName = $contractorName;
        return $this;
    }

    public function getDelete(): int
    {
        return $this->delete;
    }

    public function setDelete(int $delete): DocumentViewModel
    {
        $this->set('delete', $delete);
        $this->delete = $delete;
        return $this;
    }

    public function getAddedBy(): int
    {
        return $this->addedBy;
    }

    public function setAddedBy(int $addedBy): DocumentViewModel
    {
        $this->set('addedBy', $addedBy);
        $this->addedBy = $addedBy;
        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date = null): DocumentViewModel
    {
        $this->set('date', $date);
        $this->date = $date;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): DocumentViewModel
    {
        $this->set('name', $name);
        $this->name = $name;
        return $this;
    }

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setUuid(UUID $uuid): DocumentViewModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setId(int $id): DocumentViewModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }
}