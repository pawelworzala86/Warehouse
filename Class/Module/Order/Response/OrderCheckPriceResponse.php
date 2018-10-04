<?php

namespace App\Module\Order\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;
use App\Type\FileResponse;
use App\Type\FilesResponse;
use App\Type\OrderPrice;
use App\Type\OrderPrices;
use App\Type\OrderResponse;
use App\Type\OrdersResponse;

class OrderCheckPriceResponse extends Response
{
    public $fieldClass = OrderPrice::class;

    private $prices;

    public function getPrices(): OrderPrices
    {
        return $this->prices;
    }

    public function setPrices(OrderPrices $prices)
    {
        $this->prices = $prices;
        return $this;
    }
}