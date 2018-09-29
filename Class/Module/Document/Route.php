<?php

namespace App\Module\Document;

use App\Router;
use App\Module\Document\Handler;

return [
    Router::post('/document', Handler\CreateDocumentHandler::class),
    Router::get('/document', Handler\GetDocumentsHandler::class),
    Router::get('/document/{id}', Handler\GetDocumentHandler::class),
    Router::put('/document/{id}', Handler\UpdateDocumentHandler::class),
    Router::delete('/document/{id}', Handler\DeleteDocumentHandler::class),
    Router::get('/document/test', Handler\DocumentTestHandler::class),
];