<?php

namespace App\Module\Integration;

use App\Router;
use App\Module\Integration\Handler;

return [
    Router::get('/integration/presta/refresh', Handler\PrestaRefreshHandler::class),
    Router::put('/integration/presta/synchronize', Handler\SynchronizePrestaProductsHandler::class),

    Router::get('/integration/allegro/login', Handler\AllegroLoginHandler::class),
    Router::get('/integration/allegro/oauth', Handler\AllegroOauthHandler::class),
    Router::get('/integration/allegro/shipment', Handler\AllegroGetShipmentHandler::class),
    Router::get('/integration/allegro/shipment/prepare', Handler\AllegroPrepareShipmentHandler::class),
    Router::get('/integration/allegro/send/{id}', Handler\AllegroSendHandler::class),
];