<?php

namespace App\Modules\Production\Controller;

use App\Controller;
use App\Modules\Production\Model\ProductionDayModel;
use App\Modules\Production\Model\ProductionModel;

class ProductionDay extends Controller {

    public function __construct() {
        $this->model = new ProductionDayModel;

        if (isset($_POST['action'])) {
            /*if ($_POST['action'] == 'delete') {
                $this->model->delete($_POST['id']);
            } else if ($_POST['action'] == 'filter') {
                $this->model->filter();
            } else */if ($_POST['action'] == 'add') {
                $this->model->add($_POST);
                header('Location: /produkcja/'.$_POST['id'].'/dni');
            }
        }

        parent::__construct();
    }

    public function __invoke($id) {
        $this->assign('id', $id);
        $this->assign('date', date("d-m-Y"));
        //$this->assign('filter', $this->model->getFilter());
        $this->assign('workers', $this->model->getProductionWorkers($id));
        $this->assign('production', (new ProductionModel)->getProduction($id));
        $this->display('Production/ProductionDay');
    }

}
