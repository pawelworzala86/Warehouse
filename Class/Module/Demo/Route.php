<?php

namespace App\Module\Demo;

use App\Router;
use App\Module\Demo\Handler;

return [
    Router::get('/demo/clear', Handler\ClearHandler::class),
];