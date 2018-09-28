<?php

namespace App\Module\Session;

use App\Router;
use App\Module\Session\Handler;

return [
    Router::get('/session/create', Handler\CreateSessionHandler::class),
    Router::delete('/session/delete', Handler\DeleteSessionHandler::class),
];