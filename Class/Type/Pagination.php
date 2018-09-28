<?php

namespace App\Type;

use App\Type;

class Pagination extends Type
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