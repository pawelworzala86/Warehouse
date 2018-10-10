<?php

namespace App\Module\Order\Handler;

use App\Handler;
use App\Module\Order\Response\OrderCheckPriceResponse;
use App\Request\EmptyRequest;
use App\Container\OrderPrice;
use App\Container\OrderPrices;

class OrderCheckPriceHandler extends Handler
{
    public function __invoke(EmptyRequest $request): OrderCheckPriceResponse
    {
        $method = 'login';
        $format = 'xml';

        $email = 'worzala86@gmail.com';
        $password = md5('347142856');

        $url = "http://test.furgonetka.pl/api/$method.$format?email=$email&password=$password";

        $xml = simplexml_load_file($url);

        //print_r($xml);

        $status = $xml->getName();

        //print_r([$status]);

        $hash = null;
        if ($status == 'success') {
            $hash = $xml->hash;
        } elseif ($status == 'error') {
            foreach($xml->error as $error) {
                if(isset($error->field)) {
                    echo $error->field .': ';
                }
                echo $error->message;
                exit;
            }
        } else {
            echo 'Błąd komunikacji';
            exit;
        }









        $method = 'packageCheckPrice';
        $format = 'xml';

        $params = array();

        $params['hash'] = $hash;
        $params['type'] = 'package';

        $params['weight'] = 10;
        $params['width'] = 11;
        $params['height'] = 12;
        $params['depth'] = 13;

        //$params['guarantee'] = '0930';
        $params['sender_postcode'] = '82-300';
        $params['receiver_postcode'] = '83-200';


        $query = array();
        foreach ($params as $name => $value) {
            $query[] = $name."=".urlencode($value);
        }
        $query = implode('&',$query);

        $url = "http://test.furgonetka.pl/api/$method.$format?$query";

        $xml = simplexml_load_file($url);

        $status = $xml->getName();

        $prices = new OrderPrices;

        if ($status == 'success') {
            foreach ((array)$xml->prices as $service => $price) {
                $prices->add(
                    (new OrderPrice)
                    ->setService($service)
                    ->setPrice($price)
                );
            }
        } elseif ($status == 'error') {
            foreach($xml->error as $error) {
                if(isset($error->field)) {
                    echo $error->field .': ';
                }
                echo $error->message;
            }
        } else {
            echo 'Błąd';
        }

        $prices->rewind();
        return (new OrderCheckPriceResponse)
            ->setPrices($prices);
    }
}