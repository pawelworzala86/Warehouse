<?php

namespace App\Modules\User\Controller;

use App\Controller;

class AfterRegister extends Controller
{

    public function __invoke()
    {
        $this->display('User/AfterRegister');
    }

}
