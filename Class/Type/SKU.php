<?php

namespace App\Type;

use App\Type;

class SKU extends Type
{
    private $sku;

    function setSku(string $sku): SKU
    {
        $this->sku = $sku;
        return $this;
    }

    function getSku(): string
    {
        return $this->sku;
    }

}