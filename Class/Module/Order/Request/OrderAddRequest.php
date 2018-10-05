<?php

namespace App\Module\Order\Request;

use App\Request\UserRequest;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;

class OrderAddRequest extends UserRequest
{
    use PaginationTrait;
    use FiltersTrait;

    private $id;
    private $courier;

    public function getCourier(): ?string
    {
        return $this->courier;
    }

    public function setCourier(string $courier = null): OrderAddRequest
    {
        $this->courier = $courier;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id = null): OrderAddRequest
    {
        $this->id = $id;
        return $this;
    }
}