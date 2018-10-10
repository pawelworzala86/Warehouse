<?php

namespace App\Module\Order\Response;

use App\Response\Response;
use App\Type\UUID;

class CreateOrderResponse extends Response
{
    private $id;

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id): CreateOrderResponse
    {
        $this->id = $id;
        return $this;
    }
}