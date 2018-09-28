<?php

namespace App\Module\Catalog\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class UpdateCatalogCategoryRequest extends UserRequest
{

    public $name;
    public $lp;
    public $id;
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

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getLp(): ?int
    {
        return $this->lp;
    }

    public function setLp(int $lp = null)
    {
        $this->lp = $lp;
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