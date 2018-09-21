<?php

namespace App\Modules\Document\Controller;

use App\Controller;
use App\Modules\Document\Model\DocumentDetailModel;
use App\Template;

class DocumentDetail extends Controller{
    
    public function __construct() {
        $this->model = new DocumentDetailModel;
        
        parent::__construct();
    }

    public function __invoke($id) {
        $template = new Template(false);
        $template->assign('products', $this->model->getProducts($id));
        $template->assign('contractor', $this->model->getContractor($id));
        $template->display('Document/DocumentDetail');
        exit;
    }
}
