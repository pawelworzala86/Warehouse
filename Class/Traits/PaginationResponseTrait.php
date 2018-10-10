<?php

namespace App\Traits;

use App\Container\Pagination;

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