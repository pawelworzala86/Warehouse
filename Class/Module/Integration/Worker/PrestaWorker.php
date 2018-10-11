<?php

namespace App\Module\Integration\Worker;


use App\Curl;

class PrestaWorker
{
    private $hostName;
    private $authKey;
    private $apiUrl;
    private $curl;

    public function __construct(string $hostName, string $authKey)
    {
        $this->hostName = $hostName;
        $this->authKey = $authKey;
        $this->apiUrl = 'http://' . $this->authKey . '@' . $this->hostName . '/api/';
        $this->curl = new Curl;
    }

    public function __destruct()
    {
        $this->curl->close();
    }

    public function getProduct($prestaId){
        $url = $this->apiUrl.'products/' . $prestaId;
        $data = $this->curl->get($url);
        $xmlp = \simplexml_load_string($data, null, LIBXML_NOCDATA);
        //print_r([method_exists($xmlp, 'children')]);
        return method_exists($xmlp, 'children')?$xmlp->children()->children():null;
    }

    public function getProducts(){
        $url = $this->apiUrl.'products';
        $data = $this->curl->get($url);
        $xmlp = \simplexml_load_string($data, null, LIBXML_NOCDATA);
        return $xmlp->children()->children();
    }

    public function getImages($productId){
        $url = $this->apiUrl.'products/' . $productId;
        $data = $this->curl->get($url);
        $xmlp = \simplexml_load_string($data, null, LIBXML_NOCDATA);
        return $xmlp;
    }

    public function getImage($productId, $imageId){
        $url = $this->apiUrl.'images/products/' . $productId.'/'.$imageId;
        $data = @file_get_contents($url);
        return $data;
    }

    public function updateProduct($xml){
        $url = $this->apiUrl.'products';
        return $this->curl->put($url, $xml->asXML());
    }

    public function insertProduct($xml){
        $url = $this->apiUrl.'products';
        return \simplexml_load_string($this->curl->post($url, $xml->asXML()))->children()->children();
    }

    public function getOrders(){
        $url = $this->apiUrl.'orders';
        $data = $this->curl->get($url);
        $xml = \simplexml_load_string($data, null, LIBXML_NOCDATA);
        return $xml->children()->children();
    }

    public function getOrder($orderId){
        $url = $this->apiUrl.'orders/'.$orderId;
        $data = $this->curl->get($url);
        $xml = \simplexml_load_string($data, null, LIBXML_NOCDATA);
        return $xml->children()->children();
    }

    public function getCustomer($customerId){
        $url = $this->apiUrl.'customers/'.$customerId;
        $data = $this->curl->get($url);
        $xml = \simplexml_load_string($data, null, LIBXML_NOCDATA);
        return $xml->children()->children();
    }

    public function getAddress($addressId){
        $url = $this->apiUrl.'addresses/'.$addressId;
        $data = $this->curl->get($url);
        $xml = \simplexml_load_string($data, null, LIBXML_NOCDATA);
        return $xml->children()->children();
    }
}