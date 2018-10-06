<?php

namespace App\Module\Production\Collection;

use App\Module\Catalog\Model\ProductModel;
use App\Module\Document\Model\DocumentModel;
use App\Module\Document\Model\DocumentViewModel;
use App\Module\Document\Model\StockModel;
use App\Module\Order\Model\OrderModel;
use App\Module\Production\Model\ProductionModel;
use App\Traits\CollectionTrait;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;

class ProductionCollection extends ProductionModel
{
    use CollectionTrait;
    use PaginationTrait;
    use FiltersTrait;
}