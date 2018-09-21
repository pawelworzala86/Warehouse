<?php

namespace App\Modules\Werhouse\Controller;

use App\Controller;
use App\Modules\Werhouse\Model\WerhouseModel;
use App\Werhouse as WerhouseSingleton;

class Werhouse extends Controller
{

    public function __construct()
    {
        $this->model = new WerhouseModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'filter') {
                $this->model->filter();
            }
        }

        parent::__construct();
    }

    public function __invoke($page = 1)
    {
        $this->assign('filter', $this->model->getFilter());
        if (WerhouseSingleton::getId()) {
            $this->assign('werhouse', $this->model->getWerhouse());
        }else{
            $this->assign('werhouse', false);
        }
        $this->assign('products', $this->model->getProducts($page));
        $this->assign('addPrivilage', $this->checkPrivilage('werhouse-add'));
        $this->assign('decPrivilage', $this->checkPrivilage('werhouse-dec'));
        $this->display('Werhouse/Werhouse');
    }

}
