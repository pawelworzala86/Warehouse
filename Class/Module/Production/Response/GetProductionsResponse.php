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

class GetProductionsResponse extends Response
{
    public $fieldClass = Production::class;

    use PaginationResponseTrait;
    use FiltersTrait;

    private $productions;

    public function getProductions(): Productions
    {
        return $this->productions;
    }

    public function setProductions(Productions $productions)
    {
        $this->productions = $productions;
        return $this;
    }
}