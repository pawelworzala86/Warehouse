<?php

namespace App;

class Common {

    static public function getRandomChars($length = 16) {
        $string = '';
        $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        for($i=0;$i<$length;$i++){
            $string .= $charset[rand(0, strlen($charset)-1)];
        }
        return $string;
    }

}

