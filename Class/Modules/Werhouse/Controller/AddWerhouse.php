<?php

namespace App\Modules\Werhouse\Controller;

use App\Controller;
use App\Modules\Werhouse\Model\AddWerhouseModel;

class AddWerhouse extends Controller
{

    public function __construct()
    {
        $this->werhouse = new AddWerhouseModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'edit') {
                // ($this->checkPrivilage('worker-edit')) {
                $this->werhouse->setParams($_POST['werhouse']);
                $this->werhouse->save();
                //}
            }
        }

        parent::__construct();
    }

    public function __invoke(string $id = null)
    {
        $this->assign('werhouse', $this->werhouse->getWerhouse($id));
        $this->display('Werhouse/AddWerhouse');
    }

}
