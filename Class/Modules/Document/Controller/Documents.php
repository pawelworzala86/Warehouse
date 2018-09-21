<?php

namespace App\Modules\Document\Controller;

use App\Controller;
use App\Modules\Document\Model\DocumentsModel;
use App\Modules\Document\Model\DocumentModel;
use App\Modules\Werhouse\Model\WerhouseAddModel;

class Documents extends Controller {

    public function __construct() {
        $this->model = new DocumentsModel;

        if (isset($_POST['filter'])) {
            $this->model->filter();
        }
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'delete') {
                if ($this->checkPrivilage('document-del')) {
                    (new DocumentModel)->delete($_POST['id']);
                    $products = (new WerhouseAddModel)->delete($_POST['id']);
                    if ($products) {
                        (new WerhouseAddModel)
                                ->products($products)
                                ->add();
                    }
                }
            }
        }

        parent::__construct();
    }

    public function __invoke($id = 1) {
        $this->assign('filter', $this->model->getFilter());
        $this->assign('documents', $this->model->getDocuments($id));
        $this->assign('deletePrivilage', $this->checkPrivilage('document-del'));
        $this->assign('printPrivilage', $this->checkPrivilage('document-print'));
        $this->assign('fluentLoader', '/dokumenty');
        $this->display('Document/Documents');
    }

}
