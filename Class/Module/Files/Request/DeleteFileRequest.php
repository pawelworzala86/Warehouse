<?php

namespace App\Module\Files\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class DeleteFileRequest extends UserRequest
{
    private $id;

    function getId(): UUID
    {
        return $this->id;
    }

    function setId(UUID $id): DeleteFileRequest
    {
        $this->id = $id;
        return $this;
    }
}