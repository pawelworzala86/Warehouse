<?php

namespace App\Module\Channel;

use App\Router;
use App\Module\Channel\Handler;

return [
    Router::post('/channel', Handler\CreateChannelHandler::class),
    Router::get('/channel', Handler\GetChannelsHandler::class),
    Router::get('/channel/{id}', Handler\GetChannelHandler::class),
    Router::put('/channel/{id}', Handler\UpdateChannelHandler::class),
    Router::delete('/channel/{id}', Handler\DeleteChannelHandler::class),
];