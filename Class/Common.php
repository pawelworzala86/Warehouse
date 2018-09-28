<?php

namespace App;

use App\Type\SESSID;
use App\Type\UUID;

class Common
{
    static public function getSessid()
    {
        $string = '';
        $charset = "0123456789abcdf";
        for ($i = 0; $i < 64; $i++) {
            $string .= $charset[rand(0, strlen($charset) - 1)];
        }
        return new SESSID($string);
    }

    static public function getUuid()
    {
        $string = '';
        $charset = "0123456789abcdf";
        for ($i = 0; $i < 32; $i++) {
            $string .= $charset[rand(0, strlen($charset) - 1)];
        }
        return new UUID($string);
    }

    static public function camelCase(string $str): string
    {
        $str = preg_replace_callback('/_(.?)/', function($matches) {
            return ucfirst($matches[1]);
        }, $str);
        return $str;
    }

    static public function uncamelCase(string $str): string
    {
        $str = preg_replace('/([a-z])([A-Z])/', "\\1_\\2", $str);
        $str = strtolower($str);
        return $str;
    }

}

