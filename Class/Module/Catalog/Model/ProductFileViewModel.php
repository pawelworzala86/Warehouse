<?php

namespace App\Module\Catalog\Model;

use App\Model;
use App\Type\UUID;

class ProductFileViewModel extends Model
{
    private $id;
    private $fileUuid;
    private $productUuid;
    private $deleted;
    private $size;
    private $name;
    private $url;
    private $type;

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): ProductFileViewModel
    {
        $this->set('type', $type);
        $this->type = $type;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): ProductFileViewModel
    {
        $this->set('url', $url);
        $this->url = $url;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ProductFileViewModel
    {
        $this->set('name', $name);
        $this->name = $name;
        return $this;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): ProductFileViewModel
    {
        $this->set('size', $size);
        $this->size = $size;
        return $this;
    }

    public function getDeleted(): ?int
    {
        return $this->deleted;
    }

    public function setDeleted(int $deleted=null): ProductFileViewModel
    {
        $this->set('deleted', $deleted);
        $this->deleted = $deleted;
        return $this;
    }

    public function getProductUuid(): UUID
    {
        return $this->productUuid;
    }

    public function setProductUuid(UUID $productUuid): ProductFileViewModel
    {
        $this->set('product_uuid', hex2bin($productUuid));
        $this->productUuid = $productUuid;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ProductFileViewModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getFileUuid(): UUID
    {
        return $this->fileUuid;
    }

    public function setFileUuid(UUID $fileUuid): ProductFileViewModel
    {
        $this->set('fileUuid', hex2bin($fileUuid));
        $this->fileUuid = $fileUuid;
        return $this;
    }
}