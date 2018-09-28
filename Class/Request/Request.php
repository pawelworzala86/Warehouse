<?php

namespace App\Request;

use App\Common;
use App\Traits\CollectionTrait;
use App\Type\Error;

class Request
{
    public function setFields()
    {
        $errors = [];
        $data = [];
        if ($_POST) {
            foreach ($_POST as $key => $value) {
                $data[$key] = $value;
            }
        }
        if ($_GET) {
            foreach ($_GET as $key => $value) {
                $data[$key] = $value;
            }
        }
        if ($_FILES) {
            $files = ['file'=>null];
            for ($i = 0; @$_FILES['file']['name'][$i] != NULL; $i++) {
                if(!isset($files['file'])) {
                    $files['file'] = [];
                }
                if(!isset($files['file'][$i])) {
                    $files['file'][$i] = [];
                }
                $files['file'][$i] = [
                    'name'=>$_FILES['file']['name'][$i][0],
                    'type'=>$_FILES['file']['type'][$i][0],
                    'tmpName'=>$_FILES['file']['tmp_name'][$i][0],
                    'size'=>$_FILES['file']['size'][$i][0],
                ];
            }
            $data['file'] = $files['file'];
        }
        unset($_POST);
        unset($_GET);
        unset($_FILES);
        $this->setData($this, $data, $errors);
        return $errors;
    }

    function getValueFromData($name, $data)
    {
        if (is_object($data)) {
            return $data;
        }
        if (!isset($data[lcfirst($name)]) && !method_exists($this, $name)) {
            return null;
        }
        return isset($this->$name) ? $this->$name : $data[lcfirst($name)];
    }

    function setData(&$object, &$data, &$errors)
    {
        foreach (get_class_methods($object) as $setterName) {
            if (strpos($setterName, 'set') !== false) {
                $name = lcfirst(str_replace('set', '', $setterName));
                if (property_exists($object, $name)) {
                    $function = new \ReflectionMethod($object, $setterName);
                    $paremeters = $function->getParameters();
                    foreach ($paremeters as $parameter) {
                        $classType = (string)$parameter->getType();
                        $className = (string)$parameter->getName();
                        if (class_exists($classType)) {
                            $d = null;
                            if (isset($data[$className])) {
                                $d = $data[$className];
                            }
                            $class = null;
                            if ($d) {
                                $class = new $classType($d);
                            }
                            if ($class && in_array(CollectionTrait::class, class_uses($class))) {
                                $parentModel = get_parent_class($class);
                                $results = $this->getValueFromData($name, $data);
                                if ($results) {
                                    foreach ($results as $d) {
                                        $parentClass = new $parentModel;
                                        $class->add($this->setData($parentClass, $d, $errors));
                                    }
                                }
                                $object->{$setterName}($class);
                            } else {
                                if ($class && (get_parent_class($class) == 'App\\Type\\Enum')) {
                                    $field = Common::camelCase(str_replace('set', '', $setterName));
                                    $dataSet = new $classType($data[lcfirst($field)]);
                                    if ($dataSet) {
                                        $object->{$setterName}($dataSet);
                                    }
                                } else if ($class) {
                                    $dataSet = $this->getValueFromData($name, $data);
                                    $this->setData($class, $dataSet, $errors);
                                    if ($dataSet) {
                                        $dataSet = new $class($dataSet);
                                        $object->{$setterName}($dataSet);
                                    }
                                }
                            }
                            $default = true;
                            if(method_exists($this, $setterName)) {
                                $refMet = new \ReflectionMethod($this, $setterName);
                                $params = $refMet->getParameters();
                                if (!$params[0]->allowsNull() && (!isset($class))) {
                                    $errors[] = 'Field ' . $name . ' dont have a value!';
                                } else {
                                    $object->{$setterName}($class);
                                }
                                $default = $params[0]->isDefaultValueAvailable();
                            }

                            if(!$default&&!$class){
                                //$errors[] = 'Field ' . $name . ' dont have a value!';
                            }else {
                                $object->{$setterName}($class);
                            }
                        } else {
                            if (is_array($data)) {
                                //print_r([$name, $data]);
                                $value = $this->getValueFromData($name, $data);
                                if (!isset($value) && $parameter->isDefaultValueAvailable()) {
                                    $value = $parameter->getDefaultValue();
                                }
                                if (isset($value)) {
                                    $funct = new \ReflectionMethod($object, 'set' . ucfirst($name));
                                    $parem = $funct->getParameters();
                                    $parmClass = null;
                                    if ($parem && isset($parem[0])) {
                                        $class = $parem[0]->getType();
                                        if (class_exists($class)) {
                                            $parmClass = new $class($value);
                                        } else {
                                            $parmClass = $value;
                                        }
                                    } else {
                                        $parmClass = $value;
                                    }
                                    //$object->{$setterName}($parmClass);
                                    if (!empty($value)) {
                                        $object->{$setterName}($parmClass);
                                    } else {
                                        $errors[] = 'Field ' . $name . ' dont have a value!';
                                    }
                                }else{
                                    $funct = new \ReflectionMethod($object, 'set' . ucfirst($name));
                                    $param = $funct->getParameters();
                                    if(!$param[0]->isDefaultValueAvailable()&&empty($value)){
                                        $errors[] = 'Field ' . $name . ' dont have a value!';
                                    }
                                }
                            } else {
                                //print_r([$name, $data]);
                                if (!empty($data)) {
                                    $object->{$setterName}($data);
                                } else {
                                    $errors[] = 'Field ' . $name . ' dont have a value!';
                                }
                            }
                        }
                    }
                }
            }
        }
        return $object;
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