<?php

namespace App\Module\Catalog\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class DeleteAttachmentFromCatalogProductRequest extends UserRequest
{

    public $id;
    public $fileId;

    public function getFileId(): UUID
    {
        return $this->fileId;
    }

    public function setFileId(UUID $fileId)
    {
        $this->fileId = $fileId;
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