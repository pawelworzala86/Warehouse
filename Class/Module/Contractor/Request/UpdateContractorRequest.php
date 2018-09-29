<?php

namespace App\Module\Contractor\Request;

use App\Module\Contractor\Traits\ContractorTrait;
use App\Request\UserRequest;
use App\Type\SKU;
use App\Type\UUID;

class UpdateContractorRequest extends UserRequest
{
    use ContractorTrait;
}