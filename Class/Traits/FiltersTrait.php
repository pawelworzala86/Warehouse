<?php

namespace App\Traits;

use App\Container\Filters;

trait FiltersTrait
{
    private $filters;

    function setFilters(Filters $filters=null): self
    {
        $this->filters = $filters;
        return $this;
    }

    function getFilters(): ?Filters
    {
        return $this->filters;
    }

    function initFilters()
    {
        if(method_exists($this, 'setBeforeLoadFunctions')) {
            $this->setBeforeLoadFunctions([self::class, 'filterBeforeLoad']);
        }
    }

    function filterBeforeLoad()
    {
        $filters = $this->getFilters();
        if (!$filters) {
            return;
        }
        while ($filter = $filters->current()) {
            $this->where($filter);
            $filters->next();
        }
    }
}