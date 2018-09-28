<?php

namespace App\Module\Catalog\Response;

use App\Response\Response;
use App\Type\CatalogCategoriesList;
use App\Type\UUID;

class GetCatalogProductsXlsResponse extends Response
{
    private $id;
    private $url;
    private $name;

    function setName(string $name): GetCatalogProductsXlsResponse
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }

    function setId(UUID $id): GetCatalogProductsXlsResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }

    function setUrl(string $url): GetCatalogProductsXlsResponse
    {
        $this->url = $url;
        return $this;
    }

    function getUrl(): string
    {
        return $this->url;
    }
}