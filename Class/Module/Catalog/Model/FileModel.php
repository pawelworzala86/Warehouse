<?php

namespace App\Module\Catalog\Model;

use App\Model;
use App\Type\UUID;

class FileModel extends Model
{
    private $id;
    private $uuid;
    private $url;
    private $size;

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): FileModel
    {
        $this->set('size', $size);
        $this->size = $size;
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

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): FileModel
    {
        $this->set('id', $id);
        $this->id = $id;
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
}