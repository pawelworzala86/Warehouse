<?php

namespace App\Module\Stock\Collection;

use App\Module\Catalog\Model\ProductModel;
use App\Module\Document\Model\DocumentModel;
use App\Module\Stock\Model\StockViewModel;
use App\Traits\CollectionTrait;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;

class StockViewCollection extends StockViewModel
{
    use CollectionTrait;
    use PaginationTrait;
    use FiltersTrait;
}