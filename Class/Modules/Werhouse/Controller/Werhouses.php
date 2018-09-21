<?php

namespace App\Modules\Werhouse\Controller;

use App\Controller;
use App\Modules\Werhouse\Model\WerhousesModel;

class Werhouses extends Controller {

    public function __construct() {
        $this->model = new WerhousesModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'filter') {
                $this->model->filter();
            }
        }

        parent::__construct();
    }

    public function __invoke($page = 1) {
        $this->assign('werhouses', $this->model->getWerhouses($page));
        $this->assign('addPrivilage', $this->checkPrivilage('werhouse-add'));
        $this->assign('decPrivilage', $this->checkPrivilage('werhouse-dec'));
        $this->display('Werhouse/Werhouses');
    }

}
