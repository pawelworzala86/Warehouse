<?php

namespace App\Request;

use App\Traits\FiltersTrait;
use App\Traits\PaginationRequestTrait;

class PaginationRequest extends UserRequest
{
    use PaginationRequestTrait;
    use FiltersTrait;
}