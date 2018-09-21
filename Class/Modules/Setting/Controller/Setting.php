<?php

namespace App\Modules\Setting\Controller;

use App\Controller;
use App\Modules\Setting\Model\SettingAddressModel;
use App\Modules\Setting\Model\SettingModel;

class Setting extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new SettingModel;

        parent::__construct();
    }

    public function __invoke()
    {
        $addresId = $this->model->getAddressId();
        $this->assign('user', $this->model->getUser());
        $this->assign('address', (new SettingAddressModel)->getAddress($addresId));
        $this->display('Setting/Setting');
    }

}
