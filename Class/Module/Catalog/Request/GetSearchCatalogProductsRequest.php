<?php

namespace App\Module\Catalog\Request;

use App\Request\UserRequest;
use App\Type\SKU;
use App\Type\UUID;

class GetSearchCatalogProductsRequest extends UserRequest
{
    public $search;

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