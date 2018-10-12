<?php

namespace App\Module\Financial\Response;

use App\Container\Documents;
use App\Response\Response;
use App\Type\UUID;

class GetFinancialResponse extends Response
{
    private $date;
    private $amount;
    private $id;
    private $documents;

    public function getDocuments(): Documents
    {
        return $this->documents;
    }

    public function setDocuments(Documents $documents): GetFinancialResponse
    {
        $this->documents = $documents;
        return $this;
    }

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id): GetFinancialResponse
    {
        $this->id = $id;
        return $this;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): GetFinancialResponse
    {
        $this->amount = $amount;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): GetFinancialResponse
    {
        $this->date = $date;
        return $this;
    }
}