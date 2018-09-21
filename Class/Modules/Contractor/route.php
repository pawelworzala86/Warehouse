<?php

namespace App\Modules\Contractor;

use App\Router;
use App\Router2;

Router2::get('/api/debts', Handler\GetDebts::class);
//Router::get('/api/windykacja/:', Controller\Debts::class);
Router2::get('/api/contractors', Handler\GetContractors::class);
Router::get('/api/kontrahenci', Controller\Contractors::class, 'contractor-list');

Router::get('/api/kontrahenci/:page', Controller\Contractors::class, 'contractor-list');
Router::get('/api/kontrahent/dodaj', Controller\Contractor::class, 'contractor-edit');
Router::get('/api/kontrahent/:id/edytuj', Controller\Contractor::class, 'contractor-edit');