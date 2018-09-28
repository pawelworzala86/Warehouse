<?php

namespace App\Module\Doc\Handler;

use App\Handler;
use App\Request\EmptyRequest;

define('API_HOST', HOST.'api');

class Doc extends Handler
{
    private $routes;
    private $requests;
    private $responses;
    private $types;

    public function __invoke(EmptyRequest $request)
    {
        $this->routes = $this->getRoutes();
        foreach ($this->routes as $key => $route) {
            $route['name'] = $this->getClassNameFromHandlerClassName($route['className']);

            $request = $this->getRequestNameAndClassByHandlerClassName($route['className']);
            $route['request'] = $request['name'];
            $this->requests[$request['name']] = [
                'class' => $request['class'],
            ];

            $response = $this->getResponseNameAndClassByHandlerClassName($route['className']);
            $route['response'] = $response['name'];
            $this->responses[$response['name']] = [
                'class' => $response['class'],
            ];

            $route['url'] = API_HOST.$route['url'];

            //unset($route['className']);
            $this->routes[$key] = $route;
        }

        $this->prepereRequests();
        $this->prepereResponses();
        $this->prepereTypes();

        $documentation = [
            'routes' => $this->routes,
            'requests' => $this->requests,
            'responses' => $this->responses,
            'types' => $this->types,
        ];
        echo json_encode($documentation, JSON_PRETTY_PRINT);
    }

    private function prepareIO(&$returnMethods){
        foreach($returnMethods as $key=>$response){
            $requestProperties = [];

            if(!class_exists($response['class'])){
                continue;
            }

            $class = new $response['class'];
            $methods = get_class_methods($class);
            foreach ($methods as $method) {
                $methodName = (string)$method;
                if(strpos($methodName, 'set')!==false){
                    $propertyName = lcfirst(str_replace('set', '', $methodName));
                    if(property_exists($class, $propertyName)) {
                        $reflectionMethod = new \ReflectionMethod($class, $methodName);
                        $parameters = $reflectionMethod->getParameters();
                        $parameterType = (string)$parameters[0]->getType();
                        $parameterName = explode('\\', $parameterType);
                        $parameterName = $parameterName[count($parameterName)-1];
                        $parameterClassName = (string)$parameters[0]->getName();
                        $requestProperties[$parameterClassName] = [
                            'type'=>$parameterName,
                        ];
                        $this->types[$parameterName] = [
                            'class'=>$parameterType,
                        ];
                    }
                }
                @$response['fields'] = $requestProperties;
                //unset($response['class']);
                $returnMethods[$key] = $response;
            }
        }
    }

    private function prepereTypes(){
        $this->prepareIO($this->types);
    }

    private function prepereResponses(){
        $this->prepareIO($this->responses);
    }

    private function prepereRequests(){
        $this->prepareIO($this->requests);
    }

    private function getResponseNameAndClassByHandlerClassName($className): array
    {
        $class = new $className;
        $reflection = new \ReflectionMethod($class, '__invoke');
        $returnType = (string)$reflection->getReturnType();
        $response = $this->getResponseNameFromResponseClassName($returnType);
        return [
            'class' => $returnType,
            'name' => $response,
        ];
    }

    private function getRequestNameAndClassByHandlerClassName($className): array
    {
        $class = new $className;
        $reflection = new \ReflectionMethod($class, '__invoke');
        $parameters = $reflection->getParameters();
        $paramType = (string)$parameters[0]->getType();
        $request = $this->getRequestNameFromRequestClassName($paramType);
        return [
            'class' => $paramType,
            'name' => $request,
        ];
    }

    private function getClassNameFromHandlerClassName($className)
    {
        $className = explode('\\', $className);
        $className = $className[count($className) - 1];
        $className = str_replace('Handler', '', $className);
        return $className;
    }

    private function getRequestNameFromRequestClassName($className)
    {
        $className = explode('\\', $className);
        $className = $className[count($className) - 1];
        return $className;
    }

    private function getResponseNameFromResponseClassName($className)
    {
        $className = explode('\\', $className);
        $className = $className[count($className) - 1];
        return $className;
    }


    private function getRoutes()
    {
        $routes = [];
        foreach (glob(DIR . "/Class/Module/*") as $name) {
            if (is_dir($name)) {
                $route = require($name . '/Route.php');
                foreach ($route as $r) {
                    if($r['url']=='/doc'){
                        continue;
                    }
                    $routes[] = $r;
                }
            }
        }
        return $routes;
    }

}