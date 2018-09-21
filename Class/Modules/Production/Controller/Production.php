<?php

namespace App\Modules\Production\Controller;

use App\Controller;
use App\Modules\Production\Model\ProductionModel;

class Production extends Controller {

    public function __construct() {
        $this->production = new ProductionModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'edit') {
                if ($this->checkPrivilage('production-edit')) {
                    @$this->production->setParams($_POST['production']);
                    $this->production->save();
                }
            }
        }

        parent::__construct();
    }

    public function __invoke($id = null) {
        $this->assign('production', $this->production->getProduction($id));
        $this->display('Production/Production');
    }

}
