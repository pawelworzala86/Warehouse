<?php

namespace App\Module\User;

use App\Router;
use App\Module\User\Handler;

return [
    Router::get('/user/register/{code}/confirm/{confirmationCode}', Handler\ConfirmRegistrationHandler::class),
    Router::post('/user/register', Handler\RegisterUserHandler::class),
    Router::post('/user/login', Handler\LoginUserHandler::class),
    Router::get('/user/logout', Handler\LogoutUserHandler::class),
    Router::get('/user/status', Handler\UserStatusHandler::class),
    Router::get('/user/profile', Handler\GetUserProfileHandler::class),
    Router::post('/user/profile', Handler\UpdateUserProfileHandler::class),
];