<?php

namespace App\Modules\Other\Controller;

use App\Controller;

class Index extends Controller
{

    public function __invoke()
    {
        $this->display('Other/Dashboard');
    }

}
