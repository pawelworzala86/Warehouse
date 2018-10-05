<?php

namespace App\Module\Orders;

use App\Router;
use App\Module\Order\Handler;

return [
    Router::get('/orders', Handler\GetOrdersHandler::class),
    Router::get('/orders/check/price', Handler\OrderCheckPriceHandler::class),
    Router::post('/orders/add/{{id}}', Handler\OrderAddHandler::class),
    Router::get('/orders/call', Handler\OrderCallHandler::class),
    Router::get('/orders/refresh', Handler\OrdersRefreshHandler::class),
];