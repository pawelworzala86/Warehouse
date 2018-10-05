<?php

namespace App\Module\Order\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;
use App\Type\CallResponse;
use App\Type\CallResponses;
use App\Type\FileResponse;
use App\Type\FilesResponse;
use App\Type\OrderResponse;
use App\Type\OrdersResponse;

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