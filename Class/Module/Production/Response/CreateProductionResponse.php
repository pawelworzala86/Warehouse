<?php

namespace App\Module\Production\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;
use App\Type\FileResponse;
use App\Type\FilesResponse;
use App\Type\OrderResponse;
use App\Type\OrdersResponse;
use App\Type\Production;
use App\Type\Productions;
use App\Type\UUID;

class CreateProductionResponse extends Response
{
    private $id;

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id): CreateProductionResponse
    {
        $this->id = $id;
        return $this;
    }
}