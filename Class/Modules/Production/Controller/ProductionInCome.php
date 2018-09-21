<?php

namespace App\Modules\Production\Controller;

use App\Modules\Production\Model\ProductionModel;

class ProductionInCome extends ProductionOutCome {

    private $type;

    public function __construct() {
        $this->type = 'add';
        
        parent::__construct();
    }

    public function __invoke($id) {
        $this->assign('type', $this->type);
        $this->assign('id', $id);
        $this->assign('production', (new ProductionModel)->getProduction($id));
        $this->display('Production/ProductionOutCome');
    }

}
