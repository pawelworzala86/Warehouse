<?php

namespace App\Module\Files\Collection;

use App\Module\Files\Model\FileModel;
use App\Traits\CollectionTrait;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;

class FileCollection extends FileModel
{
    use CollectionTrait;
    use PaginationTrait;
    use FiltersTrait;
}