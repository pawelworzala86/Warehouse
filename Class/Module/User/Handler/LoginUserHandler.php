<?php

namespace App\Module\User\Handler;

use App\Handler;
use App\Module\User\Model\UserModel;
use App\Module\User\Request\LoginUserRequest;
use App\Response\ErrorResponse;
use App\Response\SuccessResponse;
use App\Container\Filter;
use App\Type\FilterKind;
use App\User;

class LoginUserHandler extends Handler
{

    public function __invoke(LoginUserRequest $request)
    {
        $userModel = (new UserModel())
            ->where(new Filter([
                'name' => 'mail',
                'kind' => new FilterKind('='),
                'value' => $request->getMail(),
            ]))
            ->load();

        if(!$userModel->isLoaded()){
            return (new ErrorResponse)
                ->setMessages(['Wrong email!']);
        }

        if ($userModel->getPassword() != hash('sha512', (string)$request->getPassword())) {
            return (new ErrorResponse)
                ->setMessages(['Wrong password!']);
        }

        User::setId($userModel->getId());

        return new SuccessResponse;
    }

}