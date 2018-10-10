<?php

namespace App\Module\Order\Response;

use App\Response\Response;
use App\Container\OrderPrice;
use App\Container\OrderPrices;

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