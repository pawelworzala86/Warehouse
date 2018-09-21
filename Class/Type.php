<?php

namespace App;


class Type
{
    public function getData(){
        $return = new \stdClass;
        foreach (get_object_vars($this) as $key => $var) {
            if (is_object($var)) {
                $return->{$key} = $var->getData();
            }else{
                $return->{$key} = $var;
            }
        }
        return $return;
    }
}