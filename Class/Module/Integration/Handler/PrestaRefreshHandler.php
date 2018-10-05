<?php

namespace App\Module\Integration\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Files\Collection\FileCollection;
use App\Module\Files\Request\GetFilesRequest;
use App\Module\Files\Response\GetFilesResponse;
use App\Module\Order\Model\OrderModel;
use App\Module\Order\Model\OrderProductModel;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;
use App\Type\FileResponse;
use App\Type\FilesResponse;
use App\Type\Filter;
use App\Type\FilterKind;
use App\Type\SKU;
use App\User;
use PshopWs\Entities\PShopWsOrders;

require_once('/var/www/werhouse/Class/Module/Integration/WebService/PSWebServiceLibrary.php');

class PrestaRefreshHandler extends Handler
{
    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        define('PS_SHOP_PATH', 'http://prestashop.localhost');
        define('PS_WS_AUTH_KEY', 'GV5QM1CQP218HD2SIRVX1LENDFAIVM8S');

        $webService = new \PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, false);
        $opt = array('resource' => 'orders');
        $xml = $webService->get($opt);
        $prestaOrders = $xml->children()->children();

        foreach($prestaOrders->order as $order) {
            $orderId = (string)$order['id'];

            $opt = array('resource' => 'orders', 'id' =>$orderId);
            $xml = $webService->get($opt);
            $prestaOrder = $xml->children()->children();

            $orderModel = (new OrderModel)
                ->where(
                    (new Filter)
                        ->setName('added_by')
                        ->setKind(new FilterKind('='))
                        ->setValue(User::getId())
                )->where(
                    (new Filter)
                        ->setName('deleted')
                        ->setKind(new FilterKind('='))
                        ->setValue(0)
                )->where(
                    (new Filter)
                        ->setName('presta_id')
                        ->setKind(new FilterKind('='))
                        ->setValue($prestaOrder->id)
                )
                ->load();
            if(!$orderModel->getId()) {
                (new OrderModel)
                    ->setUuid(Common::getUuid())
                    ->setNumber(substr_replace(Common::getUuid(), 0, 8))
                    ->setContractorId(1)
                    ->setAddressId(1)
                    ->setPrestaId($prestaOrder->id)
                    ->insert();

                foreach ($prestaOrder->associations->order_rows->order_row as $row) {
                    $prestaProductId = (string)$row->product_id;

                    /*$opt = array('resource' => 'products', 'id' =>$productId);
                    $xml = $webService->get($opt);
                    $prestaProduct = $xml->children()->children();*/

                    $product = (new ProductModel)
                        ->where(
                            (new Filter)
                                ->setName('added_by')
                                ->setKind(new FilterKind('='))
                                ->setValue(User::getId())
                        )->where(
                            (new Filter)
                                ->setName('deleted')
                                ->setKind(new FilterKind('='))
                                ->setValue(0)
                        )->where(
                            (new Filter)
                                ->setName('presta_id')
                                ->setKind(new FilterKind('='))
                                ->setValue($prestaProductId)
                        )
                        ->load();
                    $productId = null;
                    if (!$product->getId()) {
                        $productId = (new ProductModel)
                            ->setUuid(Common::getUuid())
                            ->setName($row->product_name)
                            ->setSku(new SKU(substr_replace(Common::getUuid(), 0, 8)))
                            ->setPrestaId($prestaProductId)
                            ->setSellNet(round(($row->product_price / (123) * 100 / $row->product_quantity), 2))
                            ->setVat('23')
                            ->setSellGross(round((string)$row->product_price/ $row->product_quantity, 2))
                            ->insert();
                    } else {
                        $productId = $product->getId();
                    }
                    //print_r($row);
                    (new OrderProductModel)
                        ->setUuid(Common::getUuid())
                        ->setProductId($productId)
                        ->setOrderId($orderId)
                        ->setCount((string)$row->product_quantity)
                        ->setNet(round(($row->product_price / (123) * 100 / $row->product_quantity), 2))
                        ->setVat('23')
                        ->setSumNet(round($row->product_price / (123) * 100, 2))
                        ->setSumGross(round((string)$row->product_price, 2))
                        ->insert();
                }
            }
        }

        exit;
        return new SuccessResponse;
    }
}