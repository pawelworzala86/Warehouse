<?php

namespace App\Modules\Contractor\Controller;

use App\Controller;
use App\Modules\Contractor\Model\ContractorModel;

class Contractor extends Controller {

    public function __construct() {
        $this->contractor = new ContractorModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'edit') {
                if ($this->checkPrivilage('contractor-edit')) {
                    @$this->contractor->setAddress($_POST['address']);
                    @$this->contractor->setParams($_POST['contractor']);
                    $this->contractor->save();
                }
            }
        }

        parent::__construct();
    }

    public function __invoke($id = null) {
        $contractor = $this->contractor->getContractor($id);
        $this->assign('contractor', $contractor);
        $this->assign('address', $this->contractor->getAddress($contractor['address_id']));
        $this->display('Contractor/Contractor');
    }

}
