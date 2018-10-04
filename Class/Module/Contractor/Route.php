<?php

namespace App\Module\Contractor;

use App\Router;
use App\Module\Contractor\Handler;

return [
    Router::post('/contractor', Handler\CreateContractorHandler::class),
    Router::get('/contractor', Handler\GetContractorsHandler::class),
    Router::post('/contractor/mass/delete', Handler\DeleteMassContractorsHandler::class),
    Router::post('/contractor/mass/xls', Handler\GetContractorsXlsHandler::class),
    Router::post('/contractor/mass/pdf', Handler\GetContractorsPdfHandler::class),
    Router::post('/contractor/search', Handler\GetSearchContractorsHandler::class),
    Router::get('/contractor/{id}', Handler\GetContractorHandler::class),
    Router::put('/contractor/{id}', Handler\UpdateContractorHandler::class),
    Router::delete('/contractor/{id}', Handler\DeleteContractorHandler::class),
];