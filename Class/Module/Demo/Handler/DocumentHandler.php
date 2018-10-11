<?php

namespace App\Module\Demo\Handler;

use App\Common;
use App\Container\DocumentProduct;
use App\Container\DocumentProducts;
use App\Curl;
use App\DB;
use App\Handler;
use App\LoremIpsum;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorContactModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Document\Handler\CreateDocumentHandler;
use App\Module\Document\Handler\GetDocumentNumberHandler;
use App\Module\Document\Request\CreateDocumentRequest;
use App\Module\Document\Request\GetDocumentNumberRequest;
use App\Module\Files\Model\FileModel;
use App\Modules\Product\Controller\Product;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;
use App\Type\SKU;
use App\Type\UUID;
use App\User;

class DocumentHandler extends Handler
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
        $typesNames = [
            'fvp',
            'pz',
            //'pw'=>'PW',

            'fvs',
            'wz',
            //'rw'=>'RW',
        ];

        $type = $typesNames[rand(0, count($typesNames)-1)];

        $documentNumberRequest = (new GetDocumentNumberRequest)
            ->setType($type);
        $documentNumberHandler = (new GetDocumentNumberHandler);
        $number = $documentNumberHandler($documentNumberRequest);
        //print_r($number);

        $sumGross = 0;
        $sumNet = 0;
        $products = new DocumentProducts;
        for($i=0;$i<rand(1, 5);$i++) {
            $count = null;
            if(($type=='fvs')||($type=='wz')) {
                $count = rand(1, 5);
            }else{
                $count = rand(10, 99);
            }
            $product = [];
            if(($type=='fvs')||($type=='wz')) {
                $product = $this->db()->getRow('select * from product where '.$count.'<(select `count` from stock_view where product_id=product.id) and deleted=0 and added_by=? order by rand()', [User::getId()]);
            }else{
                $product = $this->db()->getRow('select * from product where deleted=0 and added_by=? order by rand()', [User::getId()]);
            }
            $products->add(
                (new DocumentProduct)
                    ->setCount($count)
                    ->setName($product['name'])
                    ->setNet($product['sell_net'])
                    ->setProductId(new UUID(bin2hex($product['uuid'])))
                    ->setSku(new SKU($product['sku']))
                    ->setSumGross($product['sell_gross'] * $count)
                    ->setSumNet($product['sell_net'] * $count)
                    ->setVat('23')
            );
            $sumGross += $product['sell_gross'] * $count;
            $sumNet += $product['sell_net'] * $count;
        }

        $contractor = $this->db()->getRow('select * from contractor where deleted=0 and '
            .((($type=='fvp')||($type=='pz'))?' supplier=1 and ':' ')
            .' added_by=? order by rand()', [User::getId()]);

        $payed = $sumGross;
        $payment = "wire";
        if(($type=='fvs')&&(rand(0, 9)>6)){
            $payed = 0;
        }
        if($type=='fvs'){
            $payment = "money";
        }
        $documentRequest = (new CreateDocumentRequest)
            ->setBankName("mBank")
            ->setBankNumber("1234567891234567891212")
            ->setCashDocument(true)
            ->setContractorId(new UUID(bin2hex($contractor['uuid'])))
            ->setDate("2018-10-11")
            ->setDeliveryDate("2018-10-11")
            ->setDocumentNumberId($number->getDocumentNumberId())
            ->setIssuePlace("Elbląg")
            ->setKind("add")
            ->setName($number->getName())
            ->setPayDate("2018-10-25")
            ->setPayed($payed)
            ->setPayment($payment)
            ->setSumGross($sumGross)
            ->setSumNet($sumNet)
            ->setSwift("MBANK")
            ->setTax($sumGross-$sumNet)
            ->setToPay($sumGross-$payed)
            ->setType($type)
            ->setProducts($products);

        $document = new CreateDocumentHandler;
        $document($documentRequest);

        return new SuccessResponse;
    }
}