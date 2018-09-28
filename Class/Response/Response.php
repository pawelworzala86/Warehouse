<?php

namespace App\Response;


use App\Traits\CollectionTrait;

class Response
{
    public function __construct()
    {
        if (method_exists($this, 'initPagination')) {
            $this->initPagination();
        }
        if (method_exists($this, 'initFilters')) {
            $this->initFilters();
        }
        if (method_exists($this, 'initCollection')) {
            $this->initCollection();
        }
    }

    public function getFieldClass()
    {
        return $this->fieldClass;
    }

    private function getData()
    {
        $return = new \stdClass;
        foreach (get_class_methods($this) as $var) {
            if (strpos($var, 'set') !== false) {
                $propertyName = str_replace('set', '', $var);
                $propertyName = lcfirst($propertyName);
                if (property_exists($this, $propertyName)) {
                    $var = $this->{'get' . ucfirst($propertyName)}();
                    if (is_object($var) && in_array(CollectionTrait::class, class_uses($var))) {
                        $array = [];
                        $var->rewind();
                        while ($product = $var->current()) {
                            $array[] = $product->getData();
                            $var->next();
                        }
                        $return->{$propertyName} = $array;
                    } else if (is_object($var)) {
                        $return->{$propertyName} = $var->getData();
                    } else if (is_array($var)) {
                        $array = [];
                        foreach ($var as $v) {
                            if (is_object($v)) {
                                $array[] = $v->getData();
                            } else {
                                $array[] = $v;
                            }
                        }
                        $return->{$propertyName} = $array;
                    } else {
                        $return->{$propertyName} = $var;
                    }
                }
            }
        }
        return $return;
    }

    public function __toString()
    {
        $data = $this->getData();
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    function get($propertyName)
    {
        $ref = new \ReflectionObject($this);
        $props = $ref->getProperties(\ReflectionProperty::IS_PRIVATE);
        $array = [];
        foreach ($props as $prop) {
            $array[] = $prop->getName();
        }
        if (in_array($propertyName, $array)) {
            return $this->{'get' . ucfirst($propertyName)}();
        }
        return $this->{$propertyName};
    }
}