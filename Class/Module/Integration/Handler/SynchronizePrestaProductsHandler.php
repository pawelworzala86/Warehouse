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
use App\Module\Integration\Worker\PrestaWorker;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;
use App\Container\File;
use App\Container\Filter;
use App\Type\FilterKind;
use App\Type\SKU;
use App\User;

class SynchronizePrestaProductsHandler extends Handler
{
    const productXMLPath = DIR . '/Class/Module/Integration/product.xml';

    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        $channels = (new ChannelCollection)
            ->where('deleted', '=', 0)
            ->where('added_by', '=', User::getId())
            ->load();

        while($channel = $channels->current()) {
            $prestaWorker = new PrestaWorker($channel->getHost(), $channel->getKey());

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

            while ($product = $products->current()) {
                $productIntegration = (new ProductIntegrationModel)
                    ->where('added_by', '=', User::getId())
                    ->where('deleted', '=', 0)
                    ->where('sku', '=', $product->getSku())
                    ->where('channel_id', '=', $channel->getId())
                    ->where(' exists(select 1 from product where id=product_integration.product_id and deleted=0 limit 1) and ')
                    ->load();
                if ($productIntegration->getId()) {

                    $prestaProduct = $prestaWorker->getProduct($productIntegration->getPrestaId());
                    if(!$prestaProduct){
                        $products->next();
                        continue;
                    }

                    $dateUpd = strtotime((string)$prestaProduct->date_upd[0]);
                    $datePr = $product->getUpdated();

                    if ($datePr > $dateUpd) {
                        $xmlp = simplexml_load_string(file_get_contents($this::productXMLPath));
                        $productXML = $xmlp->children()->children();

                        $this->setProductXMLFromProduct($productIntegration->getPrestaId(), $productXML, $product);
                        $prestaWorker->updateProduct($xmlp);
                    } else {
                        $productModel = (new ProductModel)
                            ->load($productIntegration->getProductId());

                        $sku = !empty((string)$prestaProduct->reference) ? new SKU((string)$prestaProduct->reference) : new SKU(substr_replace(Common::getUuid(), 0, 8));
                        (new ProductModel)
                            ->setUuid($productModel->getUuid())
                            ->setName((string)$prestaProduct->name->language)
                            ->setSku($sku)
                            ->setSellNet(round((float)$prestaProduct->price, 2))
                            ->setVat('23')
                            ->setSellGross(round((float)$prestaProduct->price * 1.23, 2))
                            ->setDescriptionShort((string)$prestaProduct->description_short->language)
                            ->setDescriptionFull((string)$prestaProduct->description->language)
                            ->update();
                    }
                } else {
                    $xml = \simplexml_load_string(file_get_contents($this::productXMLPath));
                    $productXML = $xml->children()->children();
                    $this->setProductXMLFromProduct('', $productXML, $product);
                    $productXML = $prestaWorker->insertProduct($xml);

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

            $prestaProducts = $prestaWorker->getProducts();
            foreach ($prestaProducts->product as $prod) {
                $prestaProduct = $prestaWorker->getProduct($prod['id']);

                $productIntegration = (new ProductIntegrationModel)
                    ->where('deleted', '=',0)
                    ->where('added_by', '=', User::getId())
                    ->where('channel_id', '=', $channel->getId())
                    ->where('presta_id', '=', $prestaProduct->id)
                    ->load();

                if (!$productIntegration->getId()) {
                    $productId = (new ProductModel)
                        ->setUuid(Common::getUuid())
                        ->setName((string)$prestaProduct->name->language)
                        ->setSku(new SKU((string)$prestaProduct->reference))
                        ->setSellNet(round((float)$prestaProduct->price, 2))
                        ->setVat('23')
                        ->setSellGross(round((float)$prestaProduct->price * 1.23, 2))
                        ->setDescriptionShort((string)$prestaProduct->description_short->language)
                        ->setDescriptionFull((string)$prestaProduct->description->language)
                        ->insert();

                    (new ProductIntegrationModel)
                        ->setUuid(Common::getUuid())
                        ->setChannelId($channel->getId())
                        ->setProductId($productId)
                        ->setSku((string)$prestaProduct->reference)
                        ->setPrestaId($prestaProduct->id)
                        ->insert();

                    $xml = $prestaWorker->getImages($prestaProduct->id);
                    if ($xml) {
                        $prestaImage = $xml->children()->children();
                        $index = 1;
                        foreach ($prestaImage->declination as $img) {
                            $data = $prestaWorker->getImage($prestaProduct->id, $img['id']);
                            $name = trim(strtok($prestaProduct->name->language . ($index++), '?'));
                            $name = str_replace(' ', '-', $name);
                            $this->saveImage($name, $data, $productId);
                        }
                    }
                }
            }
            $channels->next();
        }

        return new SuccessResponse;
    }

    private function saveImage($name, $data, $productId){
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

    private function setProductXMLFromProduct($prestaId, &$productXML, $product){
        $productXML->id = $prestaId;
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
    }
}