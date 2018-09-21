<?php

namespace App\Modules\Product\Controller;

use App\Controller;
use App\Modules\Product\Model\CatalogModel;

class Catalog extends Controller
{

    private $catalogModel;

    public function __construct(CatalogModel $catalogModel)
    {
        $this->catalogModel = $catalogModel;

        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'delete') {
                if ($this->checkPrivilage('product-del')) {
                    $this->catalogModel->delete($_POST['id']);
                }
            } else if ($_POST['action'] == 'filter') {
                $this->catalogModel->filter();
            }
        }

        parent::__construct();
    }

    public function __invoke()
    {
        $this->assign('tree', $this->catalogModel->getCatalog());
        $this->display('Product/Catalog');
    }

}
