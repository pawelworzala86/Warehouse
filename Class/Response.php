<?php

namespace App;


class Response
{
    private function getData($obj)
    {
        $return = new \stdClass;
        foreach (get_object_vars($obj) as $key => $var) {
            if (is_object($var)) {
                $return->{$key} = $var->getData();
            }else{
                $return->{$key} = $var;
            }
        }
        return $return;
    }

    public function __toString()
    {
        $data = $this->getData($this);
        return json_encode($data, JSON_PRETTY_PRINT);
    }

}