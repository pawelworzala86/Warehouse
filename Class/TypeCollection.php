<?php

namespace App;


class TypeCollection extends CollectionIterator
{
    public function getData(){
        $data = [];
        foreach ($this as $element){
            $data[] = $element->getData();
        }
        return $data;
    }
}