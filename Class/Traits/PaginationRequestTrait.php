<?php

namespace App\Traits;

use App\Container\Pagination;

trait PaginationRequestTrait
{
    public $pagination;

    function setPagination(Pagination $pagination = null): self
    {
        //var_dump($pagination);
        /*$paginationClass = new Pagination;
        $paginationClass->setPage($pagination['page']);
        $paginationClass->setLimit($pagination['limit']);*/
        $this->pagination = $pagination;
        return $this;
    }

    function getPagination(): ?Pagination
    {
        return $this->pagination;
    }
}