<?php

namespace App\Container;

use App\Container;

class Pagination extends Container
{
    private $page;
    private $limit;

    function setLimit(int $limit): Pagination
    {
        $this->limit = $limit;
        return $this;
    }

    function getLimit(): int
    {
        return $this->limit;
    }

    function setPage(int $page): Pagination
    {
        $this->page = $page;
        return $this;
    }

    function getPage(): int
    {
        return $this->page;
    }
}