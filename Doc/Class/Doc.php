<?php

class Doc
{
    private $object;
    private $level;

    private function getDocType($name)
    {
        $reflect = new ReflectionClass($this->object);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);
        $methods = $reflect->getMethods();

        $type = 'null';
        foreach ($props as $prop) {
            if ($prop->getName() == $name) {
                foreach ($methods as $method) {
                    if ($method->getName() == 'set' . ucfirst($prop->getName())) {
                        $params = $method->getParameters();
                        foreach ($params as $param) {
                            $type = (string)$param->getType();
                            break 2;
                        }
                    }
                }
            }
        }
        return $type;
    }

    private function getDocData()
    {
        $return = new \stdClass;
        foreach (get_object_vars($this->object) as $key => $var) {
            if (is_object($var)) {
                $return->{$key} = $var->getDocData();
            } else {
                $type = $this->getDocType($key);
                if (class_exists($type)) {
                    if (is_subclass_of($type, 'App\\TypeCollection')) {
                        $type2 = $this->getDocType($key);
                        if($type==$type2) {
                            $this->level++;
                        }
                        if($this->level<3) {
                            $return->{$key} = $this->getDoc(new $type2(null));
                        }else{
                            $return->{$key} = [];
                        }
                        continue;
                    }
                }
                $return->{$key} = str_replace('App\\Type\\', '', $this->getDocType($key));
            }
        }
        return $return;
    }

    public function getDoc(object $object)
    {
        $data = null;
        if (is_subclass_of($object, 'App\\TypeCollection')) {
            $listItemType = $object->getType();
            $this->object = new $listItemType(null);
            $data = [$this->getDocData()];
        } else {
            $this->object = $object;
            $data = $this->getDocData();
        }
        return $data;
    }
}