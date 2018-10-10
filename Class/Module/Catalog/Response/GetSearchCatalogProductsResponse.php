<?php

namespace App\Module\Catalog\Response;

use App\Response\Response;
use App\Container\CatalogProduct;
use App\Container\CatalogProducts;

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