<?php

namespace App\Modules\User\Controller;

use App\Controller;
use App\Modules\User\Model\DeactivateModel;

class Deactivate extends Controller {

    public function __construct() {
        $this->deactivate = new DeactivateModel;

        parent::__construct();
    }

    public function __invoke($id) {
        $this->assign('deactivated', $this->deactivate->deactivate($id));
        $this->display('User/Deactivate');
    }

}
