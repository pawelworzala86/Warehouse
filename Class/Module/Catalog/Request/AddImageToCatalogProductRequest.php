<?php

namespace App\Module\Catalog\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class AddImageToCatalogProductRequest extends UserRequest
{

    public $id;
    public $imageId;

    public function getImageId(): UUID
    {
        return $this->imageId;
    }

    public function setImageId(UUID $imageId)
    {
        $this->imageId = $imageId;
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
}