<?php

namespace App\Modules\Werhouse\Controller;

use App\Modules\Werhouse\Controller\WerhouseAdd;

class WerhouseDec extends WerhouseAdd
{

    public function __construct()
    {
        $this->type = 'dec';
        parent::__construct();
    }

}
