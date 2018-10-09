<?php

namespace App\Module\Integration\Handler;

use App\Common;
use App\Curl;
use App\Handler;
use App\Module\Catalog\Collection\ProductCollection;
use App\Module\Catalog\Model\ProductModel;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class AddPrestaProductHandler extends Handler
{
    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        define('PS_HOST_NAME', 'prestashop.localhost');
        define('PS_WS_AUTH_KEY', 'GV5QM1CQP218HD2SIRVX1LENDFAIVM8S');

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
            )->where(
                (new Filter)
                    ->setName('presta_id')
                    ->setKind(new FilterKind('null'))
                    ->setValue(null)
            )
            ->load();

        while($product = $products->current()) {
            $xml = simplexml_load_string(file_get_contents(DIR . '/Class/Module/Integration/product.xml'));
            $productXML = $xml->children()->children();
            $productXML->id_manufacturer = null;
            $productXML->id_supplier = null;
            $productXML->id_category_default = null;
            $productXML->id_default_image = null;
            $productXML->id_default_combination = null;
            $productXML->id_tax_rules_group = null;
            @$productXML->reference = $product->getSku();
            $productXML->price = $product->getSellGross();
            $productXML->meta_description = '';
            $productXML->meta_keywords = '';
            $productXML->meta_title = $product->getName();
            $productXML->name->language = $product->getName();
            $productXML->description->language = $product->getDescriptionFull();
            $productXML->description_short->language = $product->getDescriptionShort();

            $url = 'http://' . PS_WS_AUTH_KEY . '@' . PS_HOST_NAME . '/api/products';
            $curl = new Curl;
            $data = $curl->post($url, $xml->asXML());
            $xml = simplexml_load_string($data, null, LIBXML_NOCDATA);
            $productXML = $xml->children()->children();
            //print_r($xml->asXML());
            $prestaId = @(string)$productXML->id;

            if($prestaId) {
                (new ProductModel)
                    ->setUuid($product->getUuid())
                    ->setPrestaId($prestaId)
                    ->update();
            }

            $products->next();
        }

        return new SuccessResponse;
    }
}