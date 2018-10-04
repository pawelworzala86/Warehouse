<?php

namespace App\Module\Order\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;
use App\Type\FileResponse;
use App\Type\FilesResponse;
use App\Type\OrderResponse;
use App\Type\OrdersResponse;

class GetOrdersResponse extends Response
{
    public $fieldClass = OrderResponse::class;

    use PaginationResponseTrait;
    use FiltersTrait;

    private $orders;

    public function getOrders(): OrdersResponse
    {
        return $this->orders;
    }

    public function setOrders(OrdersResponse $orders)
    {
        $this->orders = $orders;
        return $this;
    }
}