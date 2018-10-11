<?php

namespace App\Module\Order\Request;

use App\Request\UserRequest;
use App\Container\DocumentProducts;
use App\Type\UUID;

class DeleteOrderRequest extends UserRequest
{
    private $orderId;

    public function getOrderId(): UUID
    {
        return $this->orderId;
    }

    public function setOrderId(UUID $orderId): DeleteOrderRequest
    {
        $this->orderId = $orderId;
        return $this;
    }
}