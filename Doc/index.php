<?php

define('DOC_CREATE', true);

chdir('../');

require_once('vendor/autoload.php');

//chdir('Api');
require_once('Api/index.php');
require_once('Doc/Class/Doc.php');
require_once('Doc/Class/Output.php');

//chdir('../');

//echo '<style>'.file_get_contents('Doc/Doc.css').'</style>';

$doc = new Doc;
$output = new Output;

foreach($routes as $route){
    $requestName = null;
    $responseName = null;
    $handler = new $route['className'];
    $reflection = new ReflectionMethod($handler, '__invoke');
    $parameters = $reflection->getParameters();
    foreach($parameters as $param){
        if(strpos((string)$param->getType(), 'Request')){
            $requestName = (string)$param->getType();
            break;
        }
    }
    $responseName = (string)$reflection->getReturnType();

    if($responseName==''){
        continue;
    }

    $request = new $requestName;
    $response = new $responseName;

    $handlerName = explode('\\', $route['className']);
    $handlerName = $handlerName[count($handlerName)-1];
    $handlerName = str_replace('Handler', '', $handlerName);

    $output->add($route['method'], $handlerName, $route['url'], $doc->getDoc($request), $doc->getDoc($response));
}

$output->out();