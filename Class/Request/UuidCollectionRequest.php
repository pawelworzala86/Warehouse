<?php

namespace App\Request;

use App\Request\UserRequest;
use App\Type\UUIDs;

class UuidCollectionRequest extends UserRequest
{
    private $ids;

    function setIds(UUIDs $ids = null): UuidCollectionRequest
    {
        $this->ids = $ids;
        return $this;
    }

    function getIds(): UUIDs
    {
        return $this->ids;
    }
}