<?php

namespace App\Module\Integration\Model;

use App\Model;
use App\Type\UUID;

class ProductAllegroModel extends Model
{
    private $id;
    private $uuid;
    private $allegroId;
    private $productId;

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): ProductAllegroModel
    {
        $this->set('product_id', $productId);
        $this->productId = $productId;
        return $this;
    }

    public function getAllegroId(): ?int
    {
        return $this->allegroId;
    }

    public function setAllegroId(int $allegroId): ProductAllegroModel
    {
        $this->set('allegro_id', $allegroId);
        $this->allegroId = $allegroId;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): ProductAllegroModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): ProductAllegroModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}