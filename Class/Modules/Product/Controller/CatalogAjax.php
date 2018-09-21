<?php

namespace App\Modules\Product\Controller;

use App\Controller;
use App\Modules\Product\Model\CatalogModel;
use App\Modules\Product\Model\AddCatalogModel;

class CatalogAjax extends Controller
{

    private $catalogModel;
    private $addCatalogModel;

    public function __construct(CatalogModel $catalogModel, AddCatalogModel $addCatalogModel)
    {
        $this->catalogModel = $catalogModel;
        $this->addCatalogModel = $addCatalogModel;

        parent::__construct();
    }

    public function __invoke($id)
    {
        if ($id === 'add') {
            $this->addCatalogModel->add();
        }else if ($id === 'delete') {
            $this->catalogModel->delete($_POST['id']);
        }
        exit;
    }

}
