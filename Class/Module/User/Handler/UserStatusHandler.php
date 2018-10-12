<?php

namespace App\Module\User\Handler;

use App\Handler;
use App\Module\User\Request\UserStatusRequest;
use App\Module\User\Response\UserStatusResponse;
use App\User;

class UserStatusHandler extends Handler
{

    public function __invoke(UserStatusRequest $request): UserStatusResponse
    {
        return (new UserStatusResponse)
            ->setLogged(User::getId()?true:false);
    }

}