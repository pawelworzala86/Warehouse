<?php

namespace App\Module\Integration\Handler;

use App\Common;
use App\Container;
use App\Curl;
use App\Handler;
use App\Module\Catalog\Collection\ProductCollection;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Channel\Collection\ChannelCollection;
use App\Module\Files\Model\FileModel;
use App\Module\Integration\Model\ProductIntegrationModel;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;
use App\Container\File;
use App\Container\Filter;
use App\Type\FilterKind;
use App\Type\SKU;
use App\User;

class SynchronizePrestaProductsHandler extends Handler
{
    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        //define('PS_HOST_NAME', 'prestashop.localhost');
        //define('PS_WS_AUTH_KEY', 'GV5QM1CQP218HD2SIRVX1LENDFAIVM8S');

        $channels = (new ChannelCollection)
            ->where('deleted', '=', 0)
            ->where('added_by', '=', User::getId())
            ->load();

        while($channel = $channels->current()) {
            $PS_WS_AUTH_KEY = $channel->getKey();
            $PS_HOST_NAME = $channel->getHost();

            $products = (new ProductCollection)
                ->where(
                    (new Filter())
                        ->setName('added_by')
                        ->setKind(new FilterKind('='))
                        ->setValue(User::getId())
                )->where(
                    (new Filter)
                        ->setName('deleted')
                        ->setKind(new FilterKind('='))
                        ->setValue(0)
                )
                ->load();

            //print_r($products);

            while ($product = $products->current()) {
                $productIntegration = (new ProductIntegrationModel)
                    ->where('added_by', '=', User::getId())
                    ->where('deleted', '=', 0)
                    ->where('product_id', '=', $product->getId())
                    ->where('channel_id', '=', $channel->getId())
                    ->load();
                //print_r($product);
                if ($productIntegration->getId()) {
                    //update
                    $curl = new Curl;
                    $url = 'http://' . $PS_WS_AUTH_KEY . '@' . $PS_HOST_NAME . '/api/products/' . $productIntegration->getPrestaId();
                    $data = $curl->get($url);
                    $xmlp = simplexml_load_string($data, null, LIBXML_NOCDATA);
                    $prestaProduct = $xmlp->children()->children();
                    //print_r([$prestaProduct]);

                    $dateUpd = strtotime((string)$prestaProduct->date_upd[0]);
                    $datePr = $product->getUpdated();

                    //print_r([$product->getSku(), $datePr, $dateUpd]);
                    if ($datePr > $dateUpd) {
                        $xmlp = simplexml_load_string(file_get_contents(DIR . '/Class/Module/Integration/product.xml'));
                        $productXML = $xmlp->children()->children();
                        $productXML->id = $productIntegration->getPrestaId();
                        $productXML->id_manufacturer = null;
                        $productXML->id_supplier = null;
                        $productXML->id_category_default = null;
                        $productXML->id_default_image = null;
                        $productXML->id_default_combination = null;
                        $productXML->id_tax_rules_group = null;
                        $productXML->reference = (string)$product->getSku();
                        $productXML->price = $product->getSellGross();
                        $productXML->meta_description = '';
                        $productXML->meta_keywords = '';
                        $productXML->meta_title = $product->getName();
                        $productXML->name->language = $product->getName();
                        $productXML->description->language = $product->getDescriptionFull();
                        $productXML->description_short->language = $product->getDescriptionShort();

                        $url = 'http://' . $PS_WS_AUTH_KEY . '@' . $PS_HOST_NAME . '/api/products';
                        $curl = new Curl;
                        $data = $curl->put($url, $xmlp->asXML());
                    } else {
                        $productModel = (new ProductModel)
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
                                    ->setName('sku')
                                    ->setKind(new FilterKind('='))
                                    ->setValue((string)$prestaProduct->reference)
                            )
                            ->load();
                        //$productId = null;
                        //if (!$product->getId()) {
                        $sku = !empty((string)$prestaProduct->reference) ? new SKU((string)$prestaProduct->reference) : new SKU(substr_replace(Common::getUuid(), 0, 8));
                        $productId = (new ProductModel)
                            ->setUuid($productModel->getUuid())
                            ->setName((string)$prestaProduct->name->language)
                            ->setSku($sku)
                            //->setPrestaId($prestaProduct->id)
                            ->setSellNet(round((float)$prestaProduct->price, 2))
                            ->setVat('23')
                            ->setSellGross(round((float)$prestaProduct->price * 1.23, 2))
                            ->setDescriptionShort((string)$prestaProduct->description_short->language)
                            ->setDescriptionFull((string)$prestaProduct->description->language)
                            ->update();

                        /*$productIntegration = (new ProductIntegrationModel)
                            ->where('channel_id', '=', $channel->getId())
                            ->where('sku', '=', $sku)
                            ->load();*/

                        /*(new ProductIntegrationModel)
                            ->setUuid($productIntegration->getUuid())
                            ->setChannelId($channel->getId())
                            ->setProductId($productId)
                            //->setPrestaId($productId)
                            ->setSku($sku)
                            ->insert();*/

                        /*$url = 'http://'.PS_WS_AUTH_KEY.'@'.PS_HOST_NAME.'/api/images/products/'.$prestaProduct->id;
                        $xml = simplexml_load_string($curl->get($url));
                        if($xml) {
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
                        }*/
                        //}
                    }
                    //exit;
                    //$xml = simplexml_load_string($data, null, LIBXML_NOCDATA);
                } else {
                    //create
                    $xml = simplexml_load_string(file_get_contents(DIR . '/Class/Module/Integration/product.xml'));
                    $productXML = $xml->children()->children();
                    $productXML->id_manufacturer = null;
                    $productXML->id_supplier = null;
                    $productXML->id_category_default = null;
                    $productXML->id_default_image = null;
                    $productXML->id_default_combination = null;
                    $productXML->id_tax_rules_group = null;
                    @$productXML->reference = (string)$product->getSku();
                    $productXML->price = $product->getSellGross();
                    $productXML->meta_description = '';
                    $productXML->meta_keywords = '';
                    $productXML->meta_title = $product->getName();
                    $productXML->name->language = $product->getName();
                    $productXML->description->language = $product->getDescriptionFull();
                    $productXML->description_short->language = $product->getDescriptionShort();

                    $url = 'http://' . $PS_WS_AUTH_KEY . '@' . $PS_HOST_NAME . '/api/products';
                    $curl = new Curl;
                    $data = $curl->post($url, $xml->asXML());
                    $xml = simplexml_load_string($data, null, LIBXML_NOCDATA);
                    $productXML = $xml->children()->children();
                    //print_r($xml->asXML());
                    /*$prestaId = @(string)$productXML->id;

                    if ($prestaId) {
                        (new ProductModel)
                            ->setUuid($product->getUuid())
                            ->setPrestaId($prestaId)
                            ->update();
                    }*/
                    (new ProductIntegrationModel)
                        ->setUuid(Common::getUuid())
                        ->setChannelId($channel->getId())
                        ->setProductId($product->getId())
                        ->setSku((string)$product->getSku())
                        ->setPrestaId((string)$productXML->id)
                        ->insert();
                }

                $products->next();
            }

            //download
            $url = 'http://' . $PS_WS_AUTH_KEY . '@' . $PS_HOST_NAME . '/api/products';
            $curl = new Curl;
            $xml = simplexml_load_string($curl->get($url));
            $prestaProducts = $xml->children()->children();
            foreach ($prestaProducts->product as $prod) {
                $url = 'http://' . $PS_WS_AUTH_KEY . '@' . $PS_HOST_NAME . '/api/products/' . $prod['id'];
                $xml = simplexml_load_string($curl->get($url));
                $prestaProduct = $xml->children()->children();

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
                            ->setName('sku')
                            ->setKind(new FilterKind('='))
                            ->setValue((string)$prestaProduct->reference)
                    )
                    ->load();
                $productId = null;
                if (!$product->getId()) {
                    $productId = (new ProductModel)
                        ->setUuid(Common::getUuid())
                        ->setName((string)$prestaProduct->name->language)
                        ->setSku(!empty((string)$prestaProduct->reference) ? new SKU((string)$prestaProduct->reference) : new SKU(substr_replace(Common::getUuid(), 0, 8)))
                        //->setPrestaId($prestaProduct->id)
                        ->setSellNet(round((float)$prestaProduct->price, 2))
                        ->setVat('23')
                        ->setSellGross(round((float)$prestaProduct->price * 1.23, 2))
                        ->setDescriptionShort((string)$prestaProduct->description_short->language)
                        ->setDescriptionFull((string)$prestaProduct->description->language)
                        ->insert();

                    $url = 'http://' . $PS_WS_AUTH_KEY . '@' . $PS_HOST_NAME . '/api/images/products/' . $prestaProduct->id;
                    $xml = simplexml_load_string($curl->get($url));
                    if ($xml) {
                        $prestaImage = $xml->children()->children();
                        $index = 1;
                        foreach ($prestaImage->declination as $img) {
                            $data = @file_get_contents($url = 'http://' . $PS_WS_AUTH_KEY . '@' . $PS_HOST_NAME . '/api/images/products/' . $prestaProduct->id . '/' . $img['id']);
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
                $curl->close();
            }
            $channels->next();
        }

        return new SuccessResponse;
    }
}