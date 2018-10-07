<?php

namespace App\Module\Cash\Model;

use App\Model;
use App\Type\UUID;

class CashDocumentModel extends Model
{
    private $id;
    private $uuid;
    private $number;
    private $deleted;
    private $addedBy;
    private $kind;
    private $amount;
    private $date;
    private $documentId;

    public function getDocumentId(): string
    {
        return $this->documentId;
    }

    public function setDocumentId(string $documentId): CashDocumentModel
    {
        $this->set('document_id', $documentId);
        $this->documentId = $documentId;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): CashDocumentModel
    {
        $this->set('date', $date);
        $this->date = $date;
        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): CashDocumentModel
    {
        $this->set('amount', $amount);
        $this->amount = $amount;
        return $this;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function setKind(string $kind): CashDocumentModel
    {
        $this->set('kind', $kind);
        $this->kind = $kind;
        return $this;
    }

    function setNumber(string $number = null): CashDocumentModel
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
    public function setDeleted(int $deleted): CashDocumentModel
    {
        $this->set('deleted', $deleted);
        $this->deleted = $deleted;
        return $this;
    }
    
    public function getAddedBy(): int
    {
        return $this->addedBy;
    }

    public function setAddedBy(int $addedBy): CashDocumentModel
    {
        $this->set('added_by', $addedBy);
        $this->addedBy = $addedBy;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): CashDocumentModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): CashDocumentModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}