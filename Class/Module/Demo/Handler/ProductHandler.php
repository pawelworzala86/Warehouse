<?php

namespace App\Module\Demo\Handler;

use App\Common;
use App\DB;
use App\Handler;
use App\LoremIpsum;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorContactModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Files\Model\FileModel;
use App\Modules\Product\Controller\Product;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;
use App\Type\SKU;

class ProductHandler extends Handler
{
    private $db;
    private $lorem;

    public function __construct()
    {
        $this->db(DB::get());
        $this->lorem(new LoremIpsum);
    }

    private function lorem($lorem = null)
    {
        if ($lorem) {
            $this->lorem = $lorem;
            return $this;
        } else {
            return $this->lorem;
        }
    }

    private function db($db = null)
    {
        if ($db) {
            $this->db = $db;
            return $this;
        } else {
            return $this->db;
        }
    }

    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        $product = true;
        if(rand(0, 10)>7){
            $product = false;
        }

        $net = rand(1, 100)+(rand(1, 100)/100);
        $productId = (new ProductModel)
            ->setUuid(Common::getUuid())
            ->setSku(new SKU('PR'.rand(100, 999)))
            ->setName($this->lorem()->wordsR(1).((rand(0, 10)>7)?(' '.$this->lorem()->wordsR(1)):''))
            ->setSellNet($net)
            ->setVat('23')
            ->setSellGross(round($net*1.23, 2))
            ->setDescriptionShort($this->lorem()->sentences(rand(1, 3)))
            ->setDescriptionFull($this->lorem()->paragraphs(rand(2, 5), 'p'))
            ->setToSell($product?true:false)
            ->setPartial($product?false:true)
            ->insert();

        $images = [];
        foreach (glob(DIR.($product?'/DemoImg/Product/*':'/DemoImg/HalfProduct/*')) as $filename) {
            $images[] = $filename;
        }

        $image = $images[rand(0, count($images)-1)];
        $imageName = explode('/', $image);
        $imageName = $imageName[count($imageName)-1];
        $fileId = (new FileModel)
            ->setUuid(Common::getUuid())
            ->setName($imageName)
            ->setUrl(str_replace('/var/www/werhouse', '', $image))
            ->setSize(filesize($image))
            ->setType('image/jpg')
            ->insert();

        (new ProductFilesModel)
            ->setUuid(Common::getUuid())
            ->setProductId($productId)
            ->setFileId($fileId)
            ->insert();

        return new SuccessResponse;
    }
}