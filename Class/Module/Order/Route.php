<?php

namespace App\Module\Orders;

use App\Router;
use App\Module\Order\Handler;

return [
    Router::get('/orders', Handler\GetOrdersHandler::class),
    Router::post('/orders', Handler\CreateOrderHandler::class),
    Router::get('/orders/call', Handler\OrderCallHandler::class),
    Router::put('/orders/{{orderId}}', Handler\UpdateOrderHandler::class),
    Router::delete('/orders/{{orderId}}', Handler\DeleteOrderHandler::class),
    Router::get('/orders/{{orderId}}', Handler\GetOrderHandler::class),
    Router::get('/orders/check/price', Handler\OrderCheckPriceHandler::class),
    Router::post('/orders/add/{{id}}', Handler\OrderAddHandler::class),
];