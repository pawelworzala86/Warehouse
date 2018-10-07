<?php

namespace App\Module\Files\Model;

use App\Model;
use App\Type\UUID;

class FileModel extends Model
{
    private $id;
    private $uuid;
    private $addedBy;
    private $deleted;
    private $size;
    private $url;
    private $name;
    private $type;

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): FileModel
    {
        $this->set('type', $type);
        $this->type = $type;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): FileModel
    {
        $this->set('name', $name);
        $this->name = $name;
        return $this;
    }

    public function getDeleted(): ?int
    {
        return $this->deleted;
    }

    public function setDeleted(int $deleted = null): FileModel
    {
        $this->set('deleted', $deleted);
        $this->deleted = $deleted;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): FileModel
    {
        $this->set('url', $url);
        $this->url = $url;
        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size = null): FileModel
    {
        $this->set('size', $size);
        $this->size = $size;
        return $this;
    }

    public function getAddedBy(): int
    {
        return $this->addedBy;
    }

    public function setAddedBy(int $addedBy): FileModel
    {
        $this->set('added_by', $addedBy);
        $this->addedBy = $addedBy;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): FileModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id = null): FileModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }
}