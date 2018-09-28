<?php

namespace App\Module\User\Handler;

use App\Handler;
use App\Module\User\Model\UserModel;
use App\Module\User\Request\LoginUserRequest;
use App\Response\SuccessResponse;
use App\Session;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class LoginUserHandler extends Handler
{

    public function __invoke(LoginUserRequest $request): SuccessResponse
    {
        $userModel = (new UserModel())
            ->where(new Filter([
                'name' => 'mail',
                'kind' => new FilterKind('='),
                'value' => $request->getMail(),
            ]))
            ->load();

        if ($userModel->getPassword() != hash('sha512', (string)$request->getPassword())) {
            throw new \Exception('Wrong password!');
        }

        User::setId($userModel->getId());

        return new SuccessResponse;
    }

}