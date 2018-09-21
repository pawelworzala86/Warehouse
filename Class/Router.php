<?php

namespace App;

use ReflectionClass;

class Router
{

    static public function get($url, $className, $privilage = null)
    {
        $url = str_replace('/', '\/', $url);
        $p = explode('\/', $url);
        $urlParams = [];
        foreach ($p as $_p) {
            if (isset($_p[0]) && ($_p[0] == ':')) {
                $urlParams[str_replace(':', '', $_p)] = null;;
                $url = str_replace($_p, '(.*)', $url);
            }
        }
        if (preg_match('/^' . $url . '$/m', $_SERVER['REQUEST_URI'], $matches)) {
            $i = 1;
            foreach ($urlParams as $key => $param) {
                $urlParams[$key] = $matches[$i];
                $i++;
            }
            if (User::getId() && !Privilage::check($privilage)) {
                (new NoPrivilage)($privilage);
            }

            $class = new ReflectionClass($className);
            $constructor = $class->getConstructor();
            $parameters = $constructor->getParameters();
            $params = [];
            foreach ($parameters as $param) {
                if (!$param->isDefaultValueAvailable()) {
                    $paramClass = (string)$param->getType();
                    $params[] = new $paramClass;
                }
            }
            $class = call_user_func_array([DI::get($className), 'newInstance'], $params);
            call_user_func_array($class, $urlParams);
            exit;
        }
    }

}
