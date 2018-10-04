<?php

namespace App\Module\Stock;

use App\Router;
use App\Module\Stock\Handler;

return [
    Router::get('/stock', Handler\GetStocksHandler::class),
    Router::post('/stock/search', Handler\GetSearchStocksHandler::class),
    Router::post('/stock/mass/xls', Handler\GetStocksXlsHandler::class),
    Router::post('/stock/mass/pdf', Handler\GetStocksPdfHandler::class),
];