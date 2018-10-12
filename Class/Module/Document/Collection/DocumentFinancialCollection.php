<?php

namespace App\Module\Document\Collection;

use App\Module\Document\Model\DocumentFinancialModel;
use App\Traits\CollectionTrait;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;

class DocumentFinancialCollection extends DocumentFinancialModel
{
    use CollectionTrait;
    use PaginationTrait;
    use FiltersTrait;
}