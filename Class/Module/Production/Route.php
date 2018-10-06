<?php

namespace App\Module\Production;

use App\Router;
use App\Module\Production\Handler;

return [
    Router::get('/production', Handler\GetProductionsHandler::class),
    Router::post('/production', Handler\CreateProductionHandler::class),
    Router::put('/production/{id}', Handler\UpdateProductionHandler::class),
    Router::get('/production/{id}', Handler\GetProductionHandler::class),
    Router::delete('/production/{id}', Handler\DeleteProductionHandler::class),
];