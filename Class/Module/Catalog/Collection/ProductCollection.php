<?php

namespace App\Module\Catalog\Collection;

use App\Module\Catalog\Model\ProductModel;
use App\Traits\CollectionTrait;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;

class ProductCollection extends ProductModel
{
    use CollectionTrait;
    use PaginationTrait;
    use FiltersTrait;
}