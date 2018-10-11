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
use App\Module\Order\Handler\CreateOrderHandler;
use App\Module\Order\Request\CreateOrderRequest;
use App\Modules\Product\Controller\Product;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;
use App\Type\SKU;
use App\Type\UUID;
use App\User;

class OrderHandler extends Handler
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
        $documentNumberRequest = (new GetDocumentNumberRequest)
            ->setType('ord');
        $documentNumberHandler = (new GetDocumentNumberHandler);
        $number = $documentNumberHandler($documentNumberRequest);

        $sumGross = 0;
        $sumNet = 0;
        $products = new DocumentProducts;
        for($i=0;$i<rand(1, 5);$i++) {
            $count = $count = rand(1, 5);
            $product = $this->db()->getRow('select * from product where '.$count.'<(select `count` from stock_view where product_id=product.id) and deleted=0 and added_by=? order by rand()', [User::getId()]);
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
            .' added_by=? order by rand()', [User::getId()]);

        /*$payed = $sumGross;
        $payment = "wire";
        if(rand(0, 9)>6){
            $payed = 0;
        }*/
        $documentRequest = (new CreateOrderRequest)
            //->setBankName("mBank")
            //->setBankNumber("1234567891234567891212")
            //->setCashDocument(true)
            ->setContractorId(new UUID(bin2hex($contractor['uuid'])))
            ->setDate("2018-10-11")
            //->setDeliveryDate("2018-10-11")
            ->setDocumentNumberId($number->getDocumentNumberId())
            //->setIssuePlace("Elbląg")
            //->setKind("add")
            ->setName($number->getName())
            //->setPayDate("2018-10-25")
            //->setPayed($payed)
            //->setPayment($payment)
            ->setSumGross($sumGross)
            ->setSumNet($sumNet)
            ->setSumVat($sumGross-$sumNet)
            //->setSwift("MBANK")
            //->setTax($sumGross-$sumNet)
            //->setToPay($sumGross-$payed)
            //->setType($type)
            ->setProducts($products);

        $document = new CreateOrderHandler;
        $document($documentRequest);

        return new SuccessResponse;
    }
}