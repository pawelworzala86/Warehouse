<?php

namespace App\Module\Order\Collection;

use App\Module\Catalog\Model\ProductModel;
use App\Module\Document\Model\DocumentModel;
use App\Module\Document\Model\DocumentViewModel;
use App\Module\Document\Model\StockModel;
use App\Module\Order\Model\OrderModel;
use App\Module\Order\Model\OrderProductModel;
use App\Traits\CollectionTrait;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;

class OrderProductCollection extends OrderProductModel
{
    use CollectionTrait;
    use PaginationTrait;
    use FiltersTrait;
}