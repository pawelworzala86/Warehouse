<?php

namespace App\Module\Cash\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;
use App\Type\Cash;
use App\Type\Cashs;
use App\Type\UUID;

class CreateCashResponse extends Response
{
    private $id;

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