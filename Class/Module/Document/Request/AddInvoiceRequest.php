<?php

namespace App\Module\Document\Request;

use App\Request\UserRequest;
use App\Type\DocumentProducts;
use App\Type\SKU;
use App\Type\UUID;

class AddInvoiceRequest extends UserRequest
{
    private $orderId;

    public function getOrderId(): UUID
    {
        return $this->orderId;
    }

    public function setOrderId(UUID $orderId): AddInvoiceRequest
    {
        $this->orderId = $orderId;
        return $this;
    }
}