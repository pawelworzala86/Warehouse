<?php

namespace App\Traits;

use App\Container\Pagination;

trait PaginationTrait
{
    private $pagination;

    function setPagination(Pagination $pagination = null): self
    {
        if(!isset($pagination)){
            $this->setDefaultPagination();
            return $this;
        }
        $this->pagination = $pagination;
        return $this;
    }

    function getPagination(): ?Pagination
    {
        if(!isset($this->pagination)){
            $this->setDefaultPagination();
            return $this->pagination;
        }
        return $this->pagination;
    }

    function setDefaultPagination(){
        $pagination = new Pagination;
        $pagination->setPage(1);
        $pagination->setLimit(20);
        $this->setPagination($pagination);
    }

    function initPagination()
    {
        $this->setBeforeLoadFunctions([self::class, 'beforeLoad']);
        $this->setDefaultPagination();
    }

    function beforeLoad(){
        $pagination = $this->getPagination();
        if($pagination) {
            $page = $pagination->getPage();
            $limit = $pagination->getLimit();
            $offset = ($page - 1) * $limit;

            $this->offset($offset);
            $this->limit($limit);
        }
    }
}