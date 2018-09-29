<?php

namespace App\Module\Contractor;

use App\Router;
use App\Module\Contractor\Handler;

return [
    Router::post('/contractor', Handler\CreateContractorHandler::class),
    Router::get('/contractor', Handler\GetContractorsHandler::class),
    Router::get('/contractor/{id}', Handler\GetContractorHandler::class),
    Router::put('/contractor/{id}', Handler\UpdateContractorHandler::class),
    Router::delete('/contractor/{id}', Handler\DeleteContractorHandler::class),
    Router::get('/contractor/test', Handler\ContractorTestHandler::class),
];