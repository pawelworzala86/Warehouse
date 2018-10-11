<?php

namespace App\Module\Demo;

use App\Router;
use App\Module\Demo\Handler;

return [
    Router::get('/demo/clear', Handler\ClearHandler::class),
    Router::get('/demo/generate/contractor', Handler\ContractorHandler::class),
    Router::get('/demo/generate/product', Handler\ProductHandler::class),
    Router::get('/demo/generate/document', Handler\DocumentHandler::class),
];