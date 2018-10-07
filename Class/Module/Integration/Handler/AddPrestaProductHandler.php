<?php

namespace App\Module\Integration\Handler;

use App\Handler;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;

require_once('/var/www/werhouse/Class/Module/Integration/WebService/PSWebServiceLibrary.php');

class AddPrestaProductHandler extends Handler
{
    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        define('PS_HOST_NAME', 'prestashop.localhost');
        define('PS_SHOP_PATH', 'http://' . PS_HOST_NAME);
        define('PS_WS_AUTH_KEY', 'GV5QM1CQP218HD2SIRVX1LENDFAIVM8S');

        $xml = simplexml_load_string(file_get_contents(DIR.'/Class/Module/Integration/product.xml'));
        $product = $xml->children()->children();
        $product->id_manufacturer = null;
        $product->id_supplier = null;
        $product->id_category_default = null;
        $product->id_default_image = null;
        $product->id_default_combination = null;
        $product->id_tax_rules_group = null;

        $url = 'http://'.PS_WS_AUTH_KEY.'@prestashop.localhost/api/products';
        $ch = \curl_init($url);
        \curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'POST');
        \curl_setopt($ch,CURLOPT_POSTFIELDS, $xml->asXML());
        $result = \curl_exec($ch);
        print_r($result);

        \curl_close($ch);
        exit;

        return new SuccessResponse;
    }
}