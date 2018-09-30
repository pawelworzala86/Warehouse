<?php

namespace App\Module\Document\Collection;

use App\Module\Catalog\Model\ProductModel;
use App\Module\Document\Model\DocumentModel;
use App\Module\Document\Model\DocumentViewModel;
use App\Traits\CollectionTrait;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;

class DocumentViewCollection extends DocumentViewModel
{
    use CollectionTrait;
    use PaginationTrait;
    use FiltersTrait;
}