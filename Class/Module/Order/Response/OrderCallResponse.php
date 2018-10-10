<?php

namespace App\Module\Order\Response;

use App\Response\Response;
use App\Container\CallResponse;
use App\Container\CallResponses;

class OrderCallResponse extends Response
{
    public $fieldClass = CallResponse::class;

    private $orders;

    public function getOrders(): CallResponses
    {
        return $this->orders;
    }

    public function setOrders(CallResponses $orders)
    {
        $this->orders = $orders;
        return $this;
    }
}