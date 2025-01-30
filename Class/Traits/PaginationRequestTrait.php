<?php

namespace App\Traits;

use App\Container\Pagination;

trait PaginationRequestTrait
{
    public $pagination;

    function setPagination(Pagination $pagination = null): self
    {
        $this->pagination = $pagination;
        return $this;
    }

    function getPagination(): ?Pagination
    {
        return $this->pagination;
    }
}