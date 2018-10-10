<?php

namespace App\Module\Order\Request;

use App\Request\UserRequest;
use App\Type\UUID;

class GetOrderRequest extends UserRequest
{
    private $orderId;

    public function getOrderId(): UUID
    {
        return $this->orderId;
    }

    public function setOrderId(UUID $orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }
}