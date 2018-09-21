<?php

namespace App\Modules\Setting\Controller;

use App\Controller;
use App\Modules\Setting\Model\SettingAddressModel;
use App\Modules\Setting\Model\SettingModel;

class SettingAddress extends Controller {

    public function __construct() {
        $this->address = new SettingAddressModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'edit') {
                //if ($this->checkPrivilage('contractor-edit')) {
                    $this->address->setAddress($_POST['address']);
                    $this->address->save();
                //}
            }
        }

        parent::__construct();
    }

    public function __invoke() {
        $addressId = (new SettingModel)->getAddressId();
        $this->assign('address', $this->address->getAddress($addressId));
        $this->display('Setting/Address');
    }

}
