<?php

namespace App\Traits;

use App\Type\Pagination;

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