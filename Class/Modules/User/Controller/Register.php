<?php

namespace App\Modules\User\Controller;

use App\Controller;
use App\Modules\User\Model\RegisterModel;
use App\Template;
use App\Mail;
use App\Lang;

class Register extends Controller
{

    public function __construct()
    {
        $this->register = new RegisterModel;

        if (isset($_POST['mail'])) {
            $data = [
                'mail' => $_POST['mail'],
                'password' => $_POST['password'],
            ];
            if ($reg = $this->register->register($data)) {
                $template = new Template(true);
                $template->assign('password', $_POST['password']);
                $template->assign('activate', HOST . 'konto/aktywacja/' . $reg['activateHash']);
                $template->assign('delete', HOST . 'konto/usuniecie/' . $reg['deleteHash']);
                $template->assign('footerFile', Lang::getFolder() . 'Mail/Footer.html');
                $body = $template->fetch(Lang::getFolder() . 'Mail/Register');

                $mail = new Mail;
                $mail->addAddress($_POST['mail']);
                $mail->addSubject('Rejestracja w serwisie Megazin');
                $mail->addBody($body);
                $mail->send();

                header('Location: /zarejestrowano');
                exit;
            }
        }

        parent::__construct();
    }

    public function __invoke()
    {
        $this->display('Register');
    }

}
