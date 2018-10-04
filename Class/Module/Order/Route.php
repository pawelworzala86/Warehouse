<?php

namespace App\Module\Orders;

use App\Router;
use App\Module\Order\Handler;

return [
    Router::get('/orders', Handler\GetOrdersHandler::class),
    Router::get('/orders/check/price', Handler\OrderCheckPriceHandler::class),
    Router::get('/orders/refresh', Handler\OrdersRefreshHandler::class),
];