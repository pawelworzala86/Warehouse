<?php

namespace App\Module\Cash\Model;

use App\Model;
use App\Type\UUID;

class CashDocumentViewModel extends Model
{
    private $id;
    private $uuid;
    private $number;
    private $deleted;
    private $added;
    private $addedBy;
    private $amount;
    private $kind;
    private $date;
    private $hour;
    private $documentNumber;
    private $documentId;

    function setDocumentId(UUID $documentId = null): CashDocumentViewModel
    {
        $this->set('document_id', $documentId);
        $this->documentId = $documentId;
        return $this;
    }

    function getDocumentId(): ?UUID
    {
        return $this->documentId;
    }

    function setDocumentNumber(string $documentNumber = null): CashDocumentViewModel
    {
        $this->set('document_number', $documentNumber);
        $this->documentNumber = $documentNumber;
        return $this;
    }

    function getDocumentNumber(): ?string
    {
        return $this->documentNumber;
    }

    function setHour(string $hour = null): CashDocumentViewModel
    {
        $this->set('hour', $hour);
        $this->hour = $hour;
        return $this;
    }

    function getHour(): ?string
    {
        return $this->hour;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): CashDocumentViewModel
    {
        $this->set('date', $date);
        $this->date = $date;
        return $this;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function setKind(string $kind): CashDocumentViewModel
    {
        $this->set('kind', $kind);
        $this->kind = $kind;
        return $this;
    }

    public function getAdded(): ?int
    {
        return $this->added;
    }

    public function setAdded(int $added = null): CashDocumentViewModel
    {
        $this->set('added', $added);
        $this->added = $added;
        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): CashDocumentViewModel
    {
        $this->set('amount', $amount);
        $this->amount = $amount;
        return $this;
    }

    function setNumber(string $number = null): CashDocumentViewModel
    {
        $this->set('number', $number);
        $this->number = $number;
        return $this;
    }

    function getNumber(): ?string
    {
        return $this->number;
    }

    public function getDeleted(): int
    {
        return $this->deleted;
    }
    public function setDeleted(int $deleted): CashDocumentViewModel
    {
        $this->set('deleted', $deleted);
        $this->deleted = $deleted;
        return $this;
    }
    
    public function getAddedBy(): int
    {
        return $this->addedBy;
    }

    public function setAddedBy(int $addedBy): CashDocumentViewModel
    {
        $this->set('added_by', $addedBy);
        $this->addedBy = $addedBy;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): CashDocumentViewModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): CashDocumentViewModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}