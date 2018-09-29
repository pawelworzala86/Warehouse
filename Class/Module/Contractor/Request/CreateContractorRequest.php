<?php

namespace App\Module\Contractor\Request;

use App\Module\Contractor\Traits\ContractorTrait;
use App\Request\UserRequest;
use App\Type\SKU;

class CreateContractorRequest extends UserRequest
{
    use ContractorTrait;
}