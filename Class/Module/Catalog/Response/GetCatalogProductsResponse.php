<?php

namespace App\Module\Catalog\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Traits\PaginationResponseTrait;

class GetCatalogProductsResponse extends Response
{
    public $fieldClass = CatalogProduct::class;

    use PaginationResponseTrait;
    use FiltersTrait;

    public $products;

    function setProducts(CatalogProducts $products): GetCatalogProductsResponse
    {
        $this->products = $products;
        return $this;
    }

    function getProducts(): CatalogProducts
    {
        return $this->products;
    }
}