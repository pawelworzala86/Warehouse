<?php

namespace App\Module\Doc;

use App\Router;

return [
    Router::get('/doc', Handler\DocHandler::class),
];