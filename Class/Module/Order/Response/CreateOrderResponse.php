<?php

namespace App\Module\Order\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;
use App\Type\DocumentProducts;
use App\Type\FileResponse;
use App\Type\FilesResponse;
use App\Type\OrderPrice;
use App\Type\OrderPrices;
use App\Type\OrderResponse;
use App\Type\OrdersResponse;
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