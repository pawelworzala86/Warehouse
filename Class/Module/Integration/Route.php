<?php

namespace App\Module\Integration;

use App\Router;
use App\Module\Integration\Handler;

return [
    Router::get('/integration/presta/refresh', Handler\PrestaRefreshHandler::class),
];