<?php

namespace App\Traits;

use App\Container\Filters;

trait FiltersTrait
{
    private $filters;
    private $filtersNames;

    function setFiltersNames(array $filtersNames = null): self
    {
        if (!isset($filtersNames)) {
            return $this;
        }
        $this->filtersNames = $filtersNames;
        return $this;
    }

    function getFiltersNames(): ?array
    {
        if (!isset($this->filtersNames) && method_exists($this, 'getFieldsNames')) {
            $this->setFiltersNames($this->getFieldsNames());
        }
        return $this->filtersNames;
    }

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
            //print_r('kuku');
        }

        //$filters = new Filters;
        //$this->setFilters($filters);

        if(method_exists($this, 'getFieldClass')) {
            $class = $this->getFieldClass();
            $filtersNames = $this->getFieldsNames(new $class);
            $this->setFiltersNames($filtersNames);
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

    function getFieldsNames($object = null)
    {
        if(!isset($object)){
            return;
        }
        $fieldsNames = [];
        foreach (get_class_methods($object) as $methods) {
            if ((strpos($methods, 'set') !== false)) {
                $propertyName = lcfirst(str_replace('set', '', $methods));
                $fieldsNames[] = $propertyName;
            }
        }
        return $fieldsNames;
    }
}