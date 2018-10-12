<?php

namespace App\Module\Financial\Request;

use App\Container\Documents;
use App\Request\UserRequest;

class CreateFinancialRequest extends UserRequest
{
    private $date;
    private $amount;
    private $documents;

    public function getDocuments(): Documents
    {
        return $this->documents;
    }

    public function setDocuments(Documents $documents): CreateFinancialRequest
    {
        $this->documents = $documents;
        return $this;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): CreateFinancialRequest
    {
        $this->amount = $amount;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): CreateFinancialRequest
    {
        $this->date = $date;
        return $this;
    }
}