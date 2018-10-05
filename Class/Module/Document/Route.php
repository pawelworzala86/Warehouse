<?php

namespace App\Module\Document;

use App\Router;
use App\Module\Document\Handler;

return [
    Router::post('/document', Handler\CreateDocumentHandler::class),
    Router::put('/document/add/invoice/{orderId}', Handler\AddInvoiceHandler::class),
    Router::get('/document', Handler\GetDocumentsHandler::class),
    Router::post('/document/mass/delete', Handler\DeleteMassDocumentHandler::class),
    Router::post('/document/mass/xls', Handler\GetDocumentsXlsHandler::class),
    Router::post('/document/mass/pdf', Handler\GetDocumentsPdfHandler::class),
    Router::get('/document/{id}', Handler\GetDocumentHandler::class),
    Router::put('/document/{id}', Handler\UpdateDocumentHandler::class),
    Router::get('/document/{id}/print', Handler\GetDocumentPrintHandler::class),
    Router::delete('/document/{id}', Handler\DeleteDocumentHandler::class),
    Router::get('/document/number/{type}', Handler\GetDocumentNumberHandler::class),
];