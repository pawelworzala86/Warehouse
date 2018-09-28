<?php

namespace App\Request;

use App\Request\UserRequest;
use App\Traits\FiltersTrait;
use App\Traits\PaginationRequestTrait;

class PaginationRequest extends UserRequest
{
    use PaginationRequestTrait;
    use FiltersTrait;
}