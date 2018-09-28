<?php

namespace App;

class Router
{

    static function get(string $url, string $className): array
    {
        return self::check('get', $url, $className);
    }

    static function post(string $url, string $className): array
    {
        return self::check('post', $url, $className);
    }

    static function put(string $url, string $className): array
    {
        return self::check('put', $url, $className);
    }

    static function delete(string $url, string $className): array
    {
        return self::check('delete', $url, $className);
    }

    static private function check(string $method, string $url, string $className): array
    {
        return [
            'method' => strtoupper($method),
            'url' => $url,
            'className' => $className,
        ];
    }

}
