<?php

define('DEBUG', true);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'werhouse');

define('DIR', __DIR__);
define('CLASSES_DIR', 'Class');

define('SMARTY_TEMPLATE_DIR', DIR.'/Template/');
define('SMARTY_COMPILE_DIR', DIR.'/Cache/Smarty/templates_c/');
define('SMARTY_CACHE_DIR', DIR.'/Cache/Smarty/Cache/');
define('SMARTY_CONFIG_DIR', DIR.'/Cache/Smarty/Configs/');

define('HOST', 'http://werhouse.localhost/');

define('FPDF_FONTPATH', DIR.'/Fonts');

if(DEBUG){
    error_reporting(E_ALL);
    ini_set('display_errors', true);
}