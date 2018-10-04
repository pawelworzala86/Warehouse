<?php

namespace App\Module\Catalog\Model;

use App\Model;
use App\Type\UUID;

class ProductAttachmentModel extends Model
{
    private $id;
    private $uuid;
    private $fileId;
    private $productId;

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): ProductAttachmentModel
    {
        $this->set('product_id', $productId);
        $this->productId = $productId;
        return $this;
    }

    public function getFileId(): int
    {
        return $this->fileId;
    }

    public function setFileId(int $fileId): ProductAttachmentModel
    {
        $this->set('file_id', $fileId);
        $this->fileId = $fileId;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ProductAttachmentModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): ProductAttachmentModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}