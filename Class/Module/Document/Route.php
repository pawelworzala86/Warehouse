<?php

namespace App\Module\Document;

use App\Router;
use App\Module\Document\Handler;

return [
    Router::get('/document', Handler\GetDocumentsHandler::class),
    Router::get('/document/test', Handler\DocumentTestHandler::class),
];