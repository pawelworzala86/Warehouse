<?php

namespace App\Module\Catalog\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class CreateCatalogCategoryRequest extends UserRequest
{

    public $name;
    public $parentId;

    public function getParentId(): ?UUID
    {
        return $this->parentId;
    }

    public function setParentId(UUID $parentId = null)
    {
        $this->parentId = $parentId;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }
}