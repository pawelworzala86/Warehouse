<?php

namespace App\Module\Catalog\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Traits\PaginationResponseTrait;
use App\Type\Contractor;
use App\Type\Contractors;
use App\Type\Products;
use App\Type\UUID;

class GetSearchCatalogProductsResponse extends Response
{
    public $fieldClass = CatalogProduct::class;

    public $products;

    function setProducts(CatalogProducts $products): GetSearchCatalogProductsResponse
    {
        $this->products = $products;
        return $this;
    }

    function getProducts(): CatalogProducts
    {
        return $this->products;
    }
}