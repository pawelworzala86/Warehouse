<?php

namespace App\Module\Integration;

use App\Router;
use App\Module\Integration\Handler;

return [
    Router::get('/integration/presta/refresh', Handler\PrestaRefreshHandler::class),
    Router::put('/integration/presta/synchronize', Handler\SynchronizePrestaProductsHandler::class),

    Router::get('/integration/allegro/send/{id}', Handler\AllegroSendHandler::class),
];