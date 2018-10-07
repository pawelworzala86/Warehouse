<?php

namespace App\Module\Cash;

use App\Router;
use App\Module\Cash\Handler;

return [
    Router::get('/cash', Handler\GetCashsHandler::class),
    Router::post('/cash', Handler\CreateCashHandler::class),
    Router::put('/cash/close', Handler\CloseCashHandler::class),
    Router::get('/cash/{id}', Handler\GetCashHandler::class),
    Router::put('/cash/{id}', Handler\UpdateCashHandler::class),
];