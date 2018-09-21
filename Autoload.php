<?php

require_once('Config.php');

require_once('vendor/autoload.php');

spl_autoload_register(function ($className) {
    $names = explode('\\', $className);
    $className = $names[count($names) - 1];
    $names[0] = CLASSES_DIR;
    if (file_exists(join('/', $names) . '.php')) {
        require_once(join('/', $names) . '.php');
    }
});