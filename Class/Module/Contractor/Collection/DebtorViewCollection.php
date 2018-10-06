<?php

namespace App\Module\Contractor\Collection;

use App\Module\Catalog\Model\ProductModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Contractor\Model\DebtorViewModel;
use App\Traits\CollectionTrait;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;

class DebtorViewCollection extends DebtorViewModel
{
    use CollectionTrait;
    use PaginationTrait;
    use FiltersTrait;
}