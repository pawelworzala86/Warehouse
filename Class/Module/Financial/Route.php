<?php

namespace App\Module\Financial;

use App\Router;
use App\Module\Financial\Handler;

return [
    Router::post('/financial', Handler\CreateFinancialHandler::class),
    Router::get('/financial', Handler\GetFinancialsHandler::class),
    Router::get('/financial/{id}', Handler\GetFinancialHandler::class),
    Router::put('/financial/{id}', Handler\UpdateFinancialHandler::class),
    Router::delete('/financial/{id}', Handler\DeleteFinancialHandler::class),
];