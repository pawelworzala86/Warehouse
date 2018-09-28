<?php

namespace App\Module\User\Handler;

use App\Common;
use App\Handler;
use App\Module\User\Model\UserModel;
use App\Module\User\Model\UserRegisterModel;
use App\Module\User\Request\ConfirmRegistrationRequest;
use App\Response\SuccessResponse;

class ConfirmRegistrationHandler extends Handler
{

    public function __invoke(ConfirmRegistrationRequest $request): SuccessResponse
    {
        $userRegisterModel = new UserRegisterModel;
        $userRegisterModel->load($request->getCode(), true);

        $password = $userRegisterModel->getPassword();
        $mail = $userRegisterModel->getMail();

        $userModel = (new UserModel)
            ->setUuid(Common::getUuid())
            ->setMail($mail)
            ->setPassword($password);

        $userModel->insert();
        $userRegisterModel->delete();

        return new SuccessResponse;
    }

}