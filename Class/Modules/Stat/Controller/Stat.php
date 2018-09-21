<?php

namespace App\Modules\Stat\Controller;

use App\Controller;

class Stat extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(string $id = null)
    {
        $this->display('Stat/Stat');
    }

}
