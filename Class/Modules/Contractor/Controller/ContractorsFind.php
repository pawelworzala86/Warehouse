<?php

namespace App\Modules\Contractor\Controller;

use App\Controller;
use App\Modules\Contractor\Model\ContractorsFindModel;

class ContractorsFind extends Controller
{

    public function __construct()
    {
        $this->model = new ContractorsFindModel;

        parent::__construct();
    }

    public function __invoke()
    {
        $search = '';
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        }
        echo json_encode($this->model->getContractors($search, $_POST['provider'] == 'true'));
        exit;
    }
}
