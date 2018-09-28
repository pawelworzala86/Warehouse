<?php

namespace App;

if(file_exists('../Config.php')) {
    require_once("../Config.php");
}else if(file_exists('Config.php')) {
    require_once("Config.php");
}

require_once(DIR."/Autoload.php");

require_once(DIR.'/Gen/grid.php');

if(count($_POST)==0)
    $_POST = json_decode(file_get_contents('php://input'), true);

IP::getId();
new Session;

global $routes;
$routes = [];
foreach (glob(DIR."/Class/Module/*") as $name) {
    if(is_dir($name)){
        $route = require_once($name.'/Route.php');
        foreach ($route as $r){
            $routes[] = $r;
        }
    }
}

Routing::display($routes);
