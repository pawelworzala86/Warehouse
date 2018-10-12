<?php

namespace App\Module\User\Handler;

use App\Common;
use App\Handler;
use App\Module\User\Model\UserRegisterModel;
use App\Module\User\Request\RegisterUserRequest;
use App\Module\User\Response\RegisterUserResponse;
use App\Template;
use App\Type\EncodedPassword;
use PHPMailer\PHPMailer\Exception;

class RegisterUserHandler extends Handler
{

    public function __invoke(RegisterUserRequest $request): RegisterUserResponse
    {
        $encodedPassword = hash('sha512', (string)$request->getPassword());
        $confirmationCode = Common::getUuid();
        $uuid = Common::getUuid();

        $userRegisterModel = new UserRegisterModel;
        $userRegisterModel
            ->setMail($request->getMail())
            ->setPassword(new EncodedPassword($encodedPassword))
            ->setConfirmationCode($confirmationCode)
            ->setUuid($uuid)
            ->insert();

        $body = file_get_contents(DIR.'/Template/Mail/Register.html');
        $body = str_replace('{{activate}}', HOST . 'konto/' . $uuid . '/aktywuj/' . $confirmationCode, $body);

        try {
            $mail = new \App\Mail;
            $mail->addAddress($request->getMail());
            $mail->addSubject('Rejestracja w serwisie Megazin');
            $mail->addBody($body);
            $mail->send();
        }catch (Exception $e){
            print_r($e);
        }

        return (new RegisterUserResponse)
            ->setCode($uuid);
    }

}