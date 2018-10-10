<?php

namespace App\Module\Catalog\Response;

use App\Response\Response;
use App\Container\CatalogCategorys;

class GetCatalogCategoriesResponse extends Response
{
    public $categories;

    function setCategories(CatalogCategorys $categories): GetCatalogCategoriesResponse
    {
        $this->categories = $categories;
        return $this;
    }

    function getCategories(): CatalogCategorys
    {
        return $this->categories;
    }
}