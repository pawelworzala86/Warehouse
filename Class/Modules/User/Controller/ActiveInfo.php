<?php

namespace App\Modules\User\Controller;

use App\Controller;

class ActiveInfo extends Controller
{

    public function __invoke()
    {
        $this->display('User/ActiveInfo');
    }

}
