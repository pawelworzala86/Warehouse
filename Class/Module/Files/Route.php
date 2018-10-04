<?php

namespace App\Module\Files;

use App\Router;
use App\Module\Files\Handler;

return [
    Router::post('/files/upload', Handler\UploadFileHandler::class),
    Router::get('/system/files', Handler\GetFilesHandler::class),
    Router::delete('/system/files/{id}', Handler\DeleteFileHandler::class),
    Router::post('/system/files/mass/delete', Handler\DeleteMassFilesHandler::class),
    Router::post('/system/files/mass/xls', Handler\GetFilesXlsHandler::class),
    Router::post('/system/files/mass/pdf', Handler\GetFilesPdfHandler::class),
];