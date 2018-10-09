<?php

namespace App;

use App\Request\Request;
use ReflectionClass;

class Routing
{
    static function display(array $routes)
    {
        foreach ($routes as $route) {
            $url = '/api' . $route['url'];
            if ($url[strlen($url) - 1] == '/') {
                $url = substr($url, 0, strlen($url) - 1);
            }
            self::{$route['method']}($url, $route['className']);
        }
        if(!defined('DOC_CREATE')) {
            throw new \Exception('Routing not found');
        }
    }

    static function get($url, $className)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            return null;
        }
        return self::check($url, $className);
    }

    static function post($url, $className)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return null;
        }
        return self::check($url, $className);
    }

    static function put($url, $className)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
            return null;
        }
        return self::check($url, $className);
    }

    static function delete($url, $className)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            return null;
        }
        return self::check($url, $className);
    }

    static private function check($url, $className)
    {
        $url = str_replace('/', '\/', $url);
        $p = explode('\/', $url);
        $urlParams = [];
        foreach ($p as $_p) {
            if (isset($_p[0]) && ($_p[0] == '{')) {
                $urlParams[str_replace('{', '', str_replace('}', '', $_p))] = null;
                $url = str_replace($_p, '([a-zA-Z0-9]+)', $url);
            }
        }
        $url = str_replace('\/\/', '\/', $url);
        $uri = $_SERVER['REQUEST_URI'];
        if ($pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        if (preg_match_all('/^' . $url . '$/m', $uri, $matches, PREG_PATTERN_ORDER)) {
            $i = 1;
            foreach ($urlParams as $key => $param) {
                $urlParams[$key] = $matches[$i][0];
                $_POST[$key] = $matches[$i][0];
                $i++;
            }

            $class = new ReflectionClass($className);
            $constructorParams = [];
            if ($class->hasMethod('__constructor')) {
                $constructor = $class->getConstructor();
                if ($constructor) {
                    $constructorParameters = $constructor->getParameters();
                }
                foreach ($constructorParameters as $param) {
                    if (!$param->isDefaultValueAvailable()) {
                        $paramClass = (string)$param->getType();
                        $constructorParams[] = new $paramClass;
                    }
                }
            }
            $classObject = call_user_func_array([new ReflectionClass($className), 'newInstance'], $constructorParams);

            $invoke = $class->getMethod('__invoke');
            if ($invoke) {
                $invokeParameters = $invoke->getParameters();
            }
            $invokeParams = [];

            foreach ($invokeParameters as $param) {
                //if (!$param->isDefaultValueAvailable()) {
                    $paramClass = (string)$param->getType();
                    $paramClassName = (string)$param->getName();
                    $pc = new $paramClass;
                //print_r([is_subclass_of($pc, 'Request')]);
                    if (is_subclass_of($pc, Request::class)) {
                        foreach ($urlParams as $key => $param) {
                            $reMet = new \ReflectionMethod($pc, 'set' . ucfirst($key));
                            $para = $reMet->getParameters()[0];
                            $paraC = (string)$para->getType();
                            if (class_exists($paraC)) {
                                $parameterKey = explode('\\', $paraC);
                                $parameterKey = $parameterKey[count($parameterKey) - 1];
                                $parameter = new $paraC([strtolower($parameterKey) => $param]);
                                $pc->{'set' . ucfirst($key)}($parameter);
                            } else {
                                $pc->{'set' . ucfirst($key)}($param);
                            }
                        }

                        $errors = $pc->setFields();
                        //if(is_subclass_of($pc, Request::class)){
                            if(count($errors)>0){
                                //throw new \Exception('Required fields is not setted!');
                                foreach ($errors as $key=>$error){
                                    $errors[$key] = $error;
                                }
                                echo json_encode(['errors'=>$errors], JSON_PRETTY_PRINT);
                                exit;
                            }
                        //}
                    }
                    $invokeParams[$paramClassName] = $pc;
                //}
            }

            echo call_user_func_array($classObject, $invokeParams);
            exit;
        }
    }

}
