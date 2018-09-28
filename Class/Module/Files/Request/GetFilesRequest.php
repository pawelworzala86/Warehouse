<?php

namespace App\Module\Files\Request;

use App\Request\UserRequest;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;

class GetFilesRequest extends UserRequest
{
    use PaginationTrait;
    use FiltersTrait;
}