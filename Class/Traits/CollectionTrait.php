<?php

namespace App\Traits;

trait CollectionTrait
{
    private $position = 0;
    private $array = [];

    public function initCollection()
    {
        $this->position = 0;
        if (method_exists($this, 'table')) {
            $this->table($this->getTableName(new parent));
        }
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        if(isset($this->array[$this->position])) {
            return $this->array[$this->position];
        }else{
            return null;
        }
    }

    public function next()
    {
        ++$this->position;
    }

    public function add($data)
    {
        $this->array[count($this->array)] = $data;
    }

    public function load($ids = null, $uuid = false)
    {
        foreach ($this->getBeforeLoadFunctions() as $function) {
            //print_r($function);
            call_user_func_array([$function[0], $function[1]], []);
        }

        $result = $this->loadAll($ids, $uuid);
        //print_r($result);
        foreach ($result as $res) {
            $this->add(new parent($res));
        }

        foreach ($this->getAfterLoadFunctions() as $function) {
            call_user_func_array([$function[0], $function[1]], []);
        }

        $this->rewind();

        return $this;
    }
}