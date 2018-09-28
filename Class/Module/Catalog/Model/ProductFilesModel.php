<?php

namespace App\Module\Catalog\Model;

use App\Model;
use App\Type\UUID;

class ProductFilesModel extends Model
{
    private $id;
    private $uuid;
    private $fileId;
    private $productId;

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): ProductFilesModel
    {
        $this->set('product_id', $productId);
        $this->productId = $productId;
        return $this;
    }

    public function getFileId(): int
    {
        return $this->fileId;
    }

    public function setFileId(int $fileId): ProductFilesModel
    {
        $this->set('file_id', $fileId);
        $this->fileId = $fileId;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ProductFilesModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): ProductFilesModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}