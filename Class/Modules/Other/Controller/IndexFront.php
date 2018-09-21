<?php

namespace App\Modules\Other\Controller;

use App\Controller;

class IndexFront extends Controller
{

    public function __invoke()
    {
        $this->display('Other/Landing');
    }

}
