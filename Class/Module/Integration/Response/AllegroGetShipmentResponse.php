<?php

namespace App\Module\Integration\Response;

use App\Container\Shipments;
use App\Response\Response;

class AllegroGetShipmentResponse extends Response
{
    private $shipments;

    function setShipments(Shipments $shipments): AllegroGetShipmentResponse
    {
        $this->shipments = $shipments;
        return $this;
    }

    function getShipments(): Shipments
    {
        return $this->shipments;
    }
}