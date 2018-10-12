<?php

namespace App\Module\Financial\Collection;

use App\Module\Financial\Model\FinancialModel;
use App\Traits\CollectionTrait;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;

class FinancialCollection extends FinancialModel
{
    use CollectionTrait;
    use PaginationTrait;
    use FiltersTrait;
}