<?php

namespace App\Module\Contractor\Request;

use App\Request\UserRequest;
use App\Type\SKU;
use App\Type\UUID;

class GetSearchContractorsRequest extends UserRequest
{
    public $search;
    public $supplier;

    public function getSupplier(): bool
    {
        return $this->supplier;
    }

    public function setSupplier(bool $supplier)
    {
        $this->supplier = $supplier;
        return $this;
    }

    public function getSearch(): string
    {
        return $this->search;
    }

    public function setSearch(string $search)
    {
        $this->search = $search;
        return $this;
    }
}