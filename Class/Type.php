<?php

namespace App;

use App\Traits\CollectionTrait;
use App\Traits\ValidationTrait;
use stdClass;

class Type
{
    public function __construct($datas = null)
    {
        if (is_array($datas)&&!is_string($datas)) {
            foreach ($datas as $key => $data) {
                $name = Common::camelCase($key);
                $setter = 'set' . ucfirst($name);
                if (method_exists($this, $setter)) {
                    $this->{$setter}($data);
                }
            }
        } else if (isset($datas)) {
            foreach (get_class_methods($this) as $method) {
                if (strpos($method, 'set') !== false) {
                    $propertyName = lcfirst(str_replace('set', '', $method));
                    if (property_exists($this, $propertyName)) {
                        $this->{$method}($datas);
                        return;
                    }
                }
            }
        }
    }

    function getData()
    {
        if (in_array(CollectionTrait::class, class_uses($this))) {
            $returnArray = [];
            while ($node = $this->current()) {
                $returnArray[] = $node->getData();
                $this->next();
            }
            $this->rewind();
            return $returnArray;
        }

        $return = new stdClass;
        $propertiesCounter = 0;
        foreach (get_class_methods($this) as $method) {
            if (strpos($method, 'set') !== false) {
                $propertyName = lcfirst(str_replace('set', '', $method));
                if (property_exists($this, $propertyName)) {
                    $methodName = 'get' . ucfirst($propertyName);
                    $value = $this->{$methodName}();
                    if (is_object($value)) {
                        $return->{$propertyName} = $value->getData();
                    } else {
                        $return->{$propertyName} = $value;
                    }
                    $propertiesCounter++;
                }
            }
        }
        if ($propertiesCounter == 1) {
            foreach (get_class_methods($this) as $method) {
                if (strpos($method, 'set') !== false) {
                    $propertyName = lcfirst(str_replace('set', '', $method));
                    if (property_exists($this, $propertyName)) {
                        $methodName = 'get' . ucfirst($propertyName);
                        $value = $this->{$methodName}();
                        return $value;
                    }
                }
            }
        }
        return $return;
    }

    public function __toString()
    {
        foreach (get_class_methods($this) as $method) {
            if(strpos($method, 'set')!==false){
                $fieldName = lcfirst(str_replace('set', '', $method));
                if(property_exists($this, $fieldName)){
                    $return = $this->{'get'.ucfirst($fieldName)}();
                    if($return) {
                        return $return;
                    }else{
                        return '';
                    }
                }
            }
        }
        return '';
    }

    function get($propertyName){
        $ref = new \ReflectionObject($this);
        $props = $ref->getProperties(\ReflectionProperty::IS_PRIVATE);
        $array = [];
        foreach ($props as $prop){
            $array[] = $prop->getName();
        }
        if(in_array($propertyName, $array)){
            return $this->{'get'.ucfirst($propertyName)}();
        }
        return $this->{$propertyName};
    }
}