<?php

namespace App\Modules\Product\Controller;

use App\Controller;
use App\Modules\Product\Model\ProductDetailPageModel;
use App\Model\FileModel;

class ProductDetailPage extends Controller
{

    public function __construct()
    {
        $this->product = new ProductDetailPageModel;

        parent::__construct();
    }

    public function __invoke($id = null)
    {
        $this->assign('product', $this->product->getProduct($id));
        $this->display('Product/ProductDetailPage');
    }

}
