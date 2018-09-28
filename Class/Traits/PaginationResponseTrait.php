<?php

namespace App\Traits;

use App\Type\Pagination;

trait PaginationResponseTrait
{
    public $pagination;

    function setPagination(Pagination $pagination): self
    {
        $this->pagination = $pagination;
        return $this;
    }

    function getPagination(): Pagination
    {
        return $this->pagination;
    }
}