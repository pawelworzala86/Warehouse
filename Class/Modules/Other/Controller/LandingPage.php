<?php

namespace App\Modules\Other\Controller;

use App\Controller;

class LandingPage extends Controller
{

    public function __invoke()
    {
        $this->assign('imie', 'Paweł');
        $this->display('Other/LandingPage');
    }

}
