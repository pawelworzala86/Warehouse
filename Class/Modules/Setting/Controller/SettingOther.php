<?php

namespace App\Modules\Setting\Controller;

use App\Controller;
use App\Modules\Setting\Model\SettingOtherModel;

class SettingOther extends Controller {

    public function __construct() {
        $this->other = new SettingOtherModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'edit') {
                //if ($this->checkPrivilage('contractor-edit')) {
                    $this->other->setOther($_POST['other']);
                    $this->other->save();
                //}
            }
        }

        parent::__construct();
    }

    public function __invoke() {
        $this->assign('other', $this->other->getOther());
        $this->display('Setting/Other');
    }

}
