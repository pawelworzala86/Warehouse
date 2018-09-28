<?php

namespace App\Module\User\Handler;

use App\Handler;
use App\Module\User\Response\UserStatusResponse;
use App\Request\EmptyRequest;
use App\User;

class UserStatusHandler extends Handler
{

    public function __invoke(EmptyRequest $request): UserStatusResponse
    {
        return (new UserStatusResponse)
            ->setLogged(User::getId()?true:false);
    }

}