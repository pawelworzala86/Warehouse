<?php

namespace App\Module\Document\Collection;

use App\Module\Catalog\Model\ProductModel;
use App\Module\Document\Model\DocumentModel;
use App\Traits\CollectionTrait;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;

class DocumentCollection extends DocumentModel
{
    use CollectionTrait;
    use PaginationTrait;
    use FiltersTrait;
}