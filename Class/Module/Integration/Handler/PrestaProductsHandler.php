<?php

namespace App\Module\Integration\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorContactModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Document\Model\DocumentNumberModel;
use App\Module\Files\Collection\FileCollection;
use App\Module\Files\Model\FileModel;
use App\Module\Files\Request\GetFilesRequest;
use App\Module\Files\Response\GetFilesResponse;
use App\Module\Order\Model\OrderModel;
use App\Module\Order\Model\OrderProductModel;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;
use App\Type\File;
use App\Type\FileResponse;
use App\Type\FilesResponse;
use App\Type\Filter;
use App\Type\FilterKind;
use App\Type\SKU;
use App\User;
use PshopWs\Entities\PShopWsOrders;

require_once('/var/www/werhouse/Class/Module/Integration/WebService/PSWebServiceLibrary.php');

class PrestaProductsHandler extends Handler
{
    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        define('PS_HOST_NAME', 'prestashop.localhost');
        define('PS_SHOP_PATH', 'http://' . PS_HOST_NAME);
        define('PS_WS_AUTH_KEY', 'GV5QM1CQP218HD2SIRVX1LENDFAIVM8S');

        $webService = new \PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, false);
        $opt = array('resource' => 'products');
        $xml = $webService->get($opt);
        $prestaProducts = $xml->children()->children();

        foreach ($prestaProducts->product as $prod) {
            $opt = array('resource' => 'products', 'id' => $prod['id']);
            $xml = $webService->get($opt);
            $prestaProduct = $xml->children()->children();
            //print_r($prestaProduct);

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
                        ->setValue($prestaProduct->id)
                )
                ->load();
            $productId = null;
            if (!$product->getId()) {
                $productId = (new ProductModel)
                    ->setUuid(Common::getUuid())
                    ->setName((string)$prestaProduct->name->language)
                    ->setSku(!empty((string)$prestaProduct->reference) ? new SKU((string)$prestaProduct->reference) : new SKU(substr_replace(Common::getUuid(), 0, 8)))
                    ->setPrestaId($prestaProduct->id)
                    ->setSellNet(round((float)$prestaProduct->price, 2))
                    ->setVat('23')
                    ->setSellGross(round((float)$prestaProduct->price * 1.23, 2))
                    ->setDescriptionShort((string)$prestaProduct->description_short->language)
                    ->setDescriptionFull((string)$prestaProduct->description->language)
                    ->insert();
                $opt = array('resource' => 'images/products', 'id' => $prestaProduct->id);
                $xml = $webService->get($opt);
                $prestaImage = $xml->children()->children();
                $index = 1;
                foreach ($prestaImage->declination as $img) {
                    $data = @file_get_contents($url = 'http://' . PS_WS_AUTH_KEY . '@' . PS_HOST_NAME . '/api/images/products/' . $prestaProduct->id . '/' . $img['id']);
                    $name = trim(strtok($prestaProduct->link_rewrite->language . ($index++), '?'));
                    $name = str_replace(' ', '-', $name);
                    file_put_contents(DIR . '/Files/' . $name . '.jpg', $data);
                    $fileUuid = (new File)
                        ->setName($name)
                        ->setType('image/jpg')
                        ->setUuid(Common::getUuid())
                        ->setUrl('/Files/' . $name . '.jpg')
                        ->setSize(filesize(DIR . '/Files/' . $name . '.jpg'))
                        ->save();
                    $fileModel = (new FileModel)
                        ->load($fileUuid, true);
                    (new ProductFilesModel)
                        ->setUuid(Common::getUuid())
                        ->setFileId($fileModel->getId())
                        ->setProductId($productId)
                        ->insert();
                }
            }
        }

        return new SuccessResponse;
    }
}