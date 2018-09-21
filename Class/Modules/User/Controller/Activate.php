<?php

namespace App\Modules\User\Controller;

use App\Controller;
use App\Modules\User\Model\ActivateModel;

class Activate extends Controller {

    public function __construct() {
        $this->activate = new ActivateModel;

        parent::__construct();
    }

    public function __invoke($id) {
        $this->assign('activated', $this->activate->activate($id));
        $this->display('User/Activate');
    }

}
