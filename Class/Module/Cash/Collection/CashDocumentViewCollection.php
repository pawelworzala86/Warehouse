<?php

namespace App\Module\Cash\Collection;

use App\Module\Cash\Model\CashDocumentViewModel;
use App\Traits\CollectionTrait;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;

class CashDocumentViewCollection extends CashDocumentViewModel
{
    use CollectionTrait;
    use PaginationTrait;
    use FiltersTrait;
}