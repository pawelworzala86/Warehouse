<?php

namespace App\Module\Integration;

use App\Router;
use App\Module\Integration\Handler;

return [
    Router::get('/integration/presta/refresh', Handler\PrestaRefreshHandler::class),
    Router::get('/integration/presta/products', Handler\PrestaProductsHandler::class),
    Router::put('/integration/presta/products', Handler\AddPrestaProductHandler::class),

    Router::get('/integration/allegro/send/{id}', Handler\AllegroSendHandler::class),
];