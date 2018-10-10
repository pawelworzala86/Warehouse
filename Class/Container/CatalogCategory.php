<?php

namespace App\Container;

use App\Container;
use App\Type\UUID;

class CatalogCategory extends Container
{
    private $id;
    private $name;
    private $categories;
    private $parentId;

    function setParentId(UUID $parentId = null): CatalogCategory
    {
        $this->parentId = $parentId;
        return $this;
    }

    function getParentId(): ?UUID
    {
        return $this->parentId;
    }

    function setCategories(CatalogCategorys $categories = null): CatalogCategory
    {
        $this->categories = $categories;
        return $this;
    }

    function getCategories(): ?CatalogCategorys
    {
        return $this->categories;
    }

    function setId(UUID $id): CatalogCategory
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }

    function setName(string $name): CatalogCategory
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }
}