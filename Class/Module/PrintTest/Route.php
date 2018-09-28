<?php

namespace App\Module\PrintTest;

use App\Router;

return [
    Router::get('/print', Handler\PrintHandler::class),
];