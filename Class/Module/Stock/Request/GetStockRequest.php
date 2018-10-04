<?php

namespace App\Module\Stock\Request;

use App\Request\UserRequest;
use App\Type\SKU;
use App\Type\UUID;

class GetStockRequest extends UserRequest
{
    public $productId;

    public function getProductId(): UUID
    {
        return $this->productId;
    }

    public function setProductId(UUID $productId)
    {
        $this->productId = $productId;
        return $this;
    }
}