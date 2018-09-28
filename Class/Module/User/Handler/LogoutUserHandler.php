<?php

namespace App\Module\User\Handler;

use App\Handler;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;
use App\User;

class LogoutUserHandler extends Handler
{

    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        User::setId(null);
        return new SuccessResponse;
    }

}