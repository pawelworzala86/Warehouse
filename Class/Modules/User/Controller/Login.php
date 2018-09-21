<?php

namespace App\Modules\User\Controller;

use App\Controller;
use App\Modules\User\Model\LoginModel;

class Login extends Controller
{

    public function __construct()
    {
        $this->login = new LoginModel;

        if (isset($_POST['mail'])) {
            $data = [
                'mail' => $_POST['mail'],
                'password' => $_POST['password'],
            ];
            if ($this->login->checkActive($data)) {
                header('Location: /aktywuj-konto');
                exit;
            }
            if ($this->login->login($data)) {
                header('Location: /');
                exit;
            }
        }

        parent::__construct();
    }

    public function __invoke()
    {
        $this->display('User/Login');
    }

}
