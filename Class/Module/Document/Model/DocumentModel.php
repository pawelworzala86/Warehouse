<?php

namespace App\Module\Document\Model;

use App\Model;
use App\Type\UUID;

class DocumentModel extends Model
{
    private $id;
    private $uuid;

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