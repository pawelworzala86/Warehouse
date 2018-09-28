<?php

namespace App;

chdir('../');

require_once('Config.php');
require_once('vendor/autoload.php');

echo file_get_contents(DIR.'/Test/Index.html');