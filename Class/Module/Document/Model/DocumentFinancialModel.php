<?php

namespace App\Module\Document\Model;

use App\Model;
use App\Type\UUID;

class DocumentFinancialModel extends Model
{
    private $id;
    private $uuid;
    private $documentId;
    private $financialId;
    private $amount;

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount = null): DocumentFinancialModel
    {
        $this->set('amount', $amount);
        $this->amount = $amount;
        return $this;
    }

    public function getFinancialId(): int
    {
        return $this->financialId;
    }

    public function setFinancialId(int $financialId): DocumentFinancialModel
    {
        $this->set('financial_id', $financialId);
        $this->financialId = $financialId;
        return $this;
    }

    public function getDocumentId(): int
    {
        return $this->documentId;
    }

    public function setDocumentId(int $documentId): DocumentFinancialModel
    {
        $this->set('document_id', $documentId);
        $this->documentId = $documentId;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): DocumentFinancialModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): ?UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): DocumentFinancialModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}